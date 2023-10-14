<?php

namespace Facades;

use Generator;
use Mockery;
use Mockery\MockInterface;
use Phoenix\Cache\Interfaces\CacheStrategy;
use Phoenix\Core\Facades\Cache;
use Phoenix\Core\Facades\Rest;
use Phoenix\Core\Tests\TestCase;
use Phoenix\Rest\Interfaces\Handler;
use Phoenix\Rest\Interfaces\RestStrategy;
use Phoenix\Rest\Interfaces\Validation;
use Phoenix\Tests\Traits\WithInaccessibleMethods;
use ReflectionException;

class RestTest extends TestCase
{
    use WithInaccessibleMethods;

    /**
     * @var Rest&MockInterface
     */
    protected $facade;

    /**
     * @var RestStrategy&MockInterface
     */
    protected $containedMock;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->facade = Mockery::mock(Rest::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $this->containedMock = Mockery::mock(RestStrategy::class);

        $this->facade->allows('instance->getContainedInstance')
            ->andReturn($this->containedMock);
    }

    /**
     * @covers \Phoenix\Core\Facades\Event::load
     * @dataProvider providerForMethods
     */
    public function testCanProvideMethods(string $method): void
    {
        $endpoint = 'foo/bar';
        $validations = [Mockery::mock(Validation::class)];
        $handler = Mockery::mock(Handler::class);

        $this->containedMock->expects($method)
            ->once()
            ->with($endpoint, $validations, $handler);

        $this->facade::{$method}($endpoint, $validations, $handler);
    }

    public function providerForMethods(): Generator
    {
        yield ['get'];
        yield ['post'];
        yield ['put'];
        yield ['delete'];
        yield ['patch'];
        yield ['options'];
    }

    /**
     * @covers \Phoenix\Core\Facades\Event::abstractInstance
     * @throws ReflectionException
     */
    public function testAbstractInstanceMatchesExpected(): void
    {
        $actual = $this->callInaccessibleMethod(new Cache(), 'abstractInstance');

        $this->assertEquals(CacheStrategy::class, $actual);
    }
}
