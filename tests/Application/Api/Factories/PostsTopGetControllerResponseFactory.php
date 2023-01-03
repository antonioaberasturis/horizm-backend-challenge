<?php

declare(strict_types=1);

namespace Tests\Application\Api\Factories;

use Faker\Generator;
use Domain\Post\Post;
use Domain\User\User;

class PostsTopGetControllerResponseFactory
{
    public static function create(): array
    {
        /** @var Generator $faker */
        $faker = app()->make(Generator::class);
        
        $data = [
            'id' => $faker->uuid(),
            'title' => $faker->realText(150),
            'body' => $faker->realText(250),
            'rating' => $faker->numberBetween(1, 5),
            'username' => $faker->name(),
            'userId' => $faker->uuid(),
        ];

        /** @var User $user */
        $user = User::factory()
                    ->id($data['userId'])
                    ->name($data['username'])
                    ->create();
        $post = Post::factory()
                    ->id($data['id'])
                    ->for($user)
                    ->title($data['title'])
                    ->body($data['body'])
                    ->rating($data['rating'])
                    ->create();

        $user->top_post()->associate($post)->save();
        
        return [$data];
    }
}
