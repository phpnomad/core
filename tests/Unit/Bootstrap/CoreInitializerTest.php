<?php

namespace Phoenix\Core\Tests\Unit\Bootstrap;

use Generator;
use Phoenix\Core\Bootstrap\CoreInitializer;
use Phoenix\Core\Facades\Cache;
use Phoenix\Core\Facades\Event;
use Phoenix\Core\Facades\Rest;
use Phoenix\Core\Strategies\Logger as LoggerStrategy;
use Phoenix\Core\Tests\TestCase;
use Phoenix\Core\Facades\Logger;
use Phoenix\Logger\Interfaces\LoggerStrategy as CoreLoggerStrategy;
use Phoenix\Tests\Traits\WithInaccessibleProperties;
use ReflectionException;

class CoreInitializerTest extends TestCase
{
    use WithInaccessibleProperties;

    /**
     * @covers \Phoenix\Core\Bootstrap\CoreInitializer::shouldLoad
     * @param bool $expected
     * @param string $version
     * @return void
     * @throws ReflectionException
     * @dataProvider providerShouldLoad
     */
    public function testShouldLoad(bool $expected, string $version): void
    {
        $initializer = new CoreInitializer();
        $this->setProtectedProperty($initializer, 'phpVersion', $version);
        $this->assertEquals($expected, $initializer->shouldLoad());
    }

    public function providerShouldLoad(): Generator
    {
        yield 'supports php 7.4' => [true, '7.4'];
        yield 'supports php 7.5' => [true, '7.5'];
        yield 'supports php 8.0' => [true, '8.0'];
        yield 'supports php 8.1' => [true, '8.1'];
        yield 'supports php 8.2' => [true, '8.2'];
    }

    /**
     * @covers \Phoenix\Core\Bootstrap\CoreInitializer::getFacades
     * @return void
     */
    public function testGetFacades(): void
    {
        $this->assertEquals([
            Logger::instance(),
            Cache::instance(),
            Event::instance(),
            Rest::instance()
        ], (new CoreInitializer())->getFacades());
    }

    /**
     * @covers \Phoenix\Core\Bootstrap\CoreInitializer::getClassDefinitions
     * @return void
     */
    public function testGetClassDefinitions(): void
    {
        $this->assertEquals(
            [LoggerStrategy::class => CoreLoggerStrategy::class],
            (new CoreInitializer())->getClassDefinitions()
        );
    }
}
