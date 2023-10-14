<?php

namespace Phoenix\Core\Tests\Unit\Facades;

use Mockery;
use Mockery\MockInterface;
use Phoenix\Core\Facades\Event;
use Phoenix\Core\Tests\TestCase;
use Phoenix\Events\Interfaces\Event as EventObject;
use Phoenix\Events\Interfaces\EventStrategy;
use Phoenix\Tests\Traits\WithInaccessibleMethods;
use ReflectionException;

class EventTest extends TestCase
{
    use WithInaccessibleMethods;

    /**
     * @var Event&MockInterface
     */
    protected $facade;

    /**
     * @var EventStrategy&MockInterface
     */
    protected $containedMock;

    public function setUp(): void
    {
        parent::setUp();
        $this->facade = Mockery::mock(Event::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $this->containedMock = Mockery::mock(EventStrategy::class);

        $this->facade->allows('instance->getContainedInstance')
            ->andReturn($this->containedMock);
    }

    /**
     * @covers \Phoenix\Core\Facades\Event::broadcast
     * @return void
     */
    public function testCanBroadcast(): void
    {
        $mockEvent = Mockery::mock(EventObject::class);

        $this->containedMock->expects('broadcast')
            ->once()
            ->with($mockEvent);

        $this->facade::broadcast($mockEvent);
    }

    /**
     * @covers \Phoenix\Core\Facades\Event::attach
     * @return void
     */
    public function testCanAttach(): void
    {
        $callable = function () {
        };

        $this->containedMock->expects('attach')
            ->once()
            ->with(EventObject::class, $callable, 10);

        $this->facade::attach(EventObject::class, $callable, 10);
    }

    /**
     * @covers \Phoenix\Core\Facades\Event::detach
     * @return void
     */
    public function testCanDetach(): void
    {
        $callable = function () {
        };

        $this->containedMock->expects('detach')
            ->once()
            ->with(EventObject::class, $callable, 10);

        $this->facade::detach(EventObject::class, $callable, 10);
    }

    /**
     * @covers \Phoenix\Core\Facades\Event::abstractInstance
     * @throws ReflectionException
     */
    public function testAbstractInstanceMatchesExpected(): void
    {
        $actual = $this->callInaccessibleMethod(new Event(), 'abstractInstance');

        $this->assertEquals(EventStrategy::class, $actual);
    }
}
