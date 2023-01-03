<?php

declare(strict_types=1);

namespace Tests\Shared;

use Faker\Factory;
use Faker\Generator;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

abstract class UnitTestCase extends MockeryTestCase
{
    protected static $faker;

    protected function mock(string $className): MockInterface
    {
        return Mockery::mock($className);
    }

    protected function faker(): Generator
    {
        return static::$faker = static::$faker ?? Factory::create();
    }
}
