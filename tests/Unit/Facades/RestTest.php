<?php

namespace PHPNomad\Core\Tests\Unit\Facades;

use Generator;
use Mockery;
use Mockery\MockInterface;
use PHPNomad\Cache\Interfaces\CacheStrategy;
use PHPNomad\Core\Facades\Cache;
use PHPNomad\Core\Facades\Rest;
use PHPNomad\Core\Tests\TestCase;
use PHPNomad\Rest\Interfaces\Handler;
use PHPNomad\Rest\Interfaces\RestStrategy;
use PHPNomad\Rest\Interfaces\Validation;
use PHPNomad\Tests\Traits\WithInaccessibleMethods;
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
     * @covers \PHPNomad\Core\Facades\Event::load
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
     * @covers \PHPNomad\Core\Facades\Event::abstractInstance
     * @throws ReflectionException
     */
    public function testAbstractInstanceMatchesExpected(): void
    {
        $actual = $this->callInaccessibleMethod(new Cache(), 'abstractInstance');

        $this->assertEquals(CacheStrategy::class, $actual);
    }
}
