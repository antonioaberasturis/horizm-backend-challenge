<?php

namespace Tests\Domain\Post\Factories;

use Domain\Post\DataTransferObjects\FindPostData;
use Faker\Factory;

class FindPostDataFactory
{
    public static function create(): FindPostData
    {
        return new FindPostData(Factory::create()->uuid());
    }
}
