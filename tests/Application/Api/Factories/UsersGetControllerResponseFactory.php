<?php

declare(strict_types=1);

namespace Tests\Application\Api\Factories;

use Domain\Post\Post;
use Faker\Generator;
use Domain\User\User;
use Domain\User\Collections\UserCollection;

class UsersGetControllerResponseFactory
{
    public static function create(): UserCollection
    {
        /** @var UserCollection $users */
        $users = User::factory()
                    ->hasPosts(1)
                    ->count(2)
                    ->create();

        return $users->sortBy('rating')
                    ->values();
    }
}
