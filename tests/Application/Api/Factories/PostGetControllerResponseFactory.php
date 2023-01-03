<?php

namespace Tests\Application\Api\Factories;

use Faker\Generator;
use Domain\Post\Post;
use Domain\User\User;

class PostGetControllerResponseFactory
{
    public static function create(): array
    {
        /** @var Generator $faker */
        $faker = app()->make(Generator::class);
        
        $data =  [
            'id' => $faker->uuid(),
            'title' => $faker->title(150),
            'body' => $faker->realText(250),
            'username' => $faker->name(),
        ];

        $user = User::factory()
                    ->name($data['username'])
                    ->create();
                    
        $post = Post::factory()
                    ->id($data['id'])
                    ->for($user)
                    ->title($data['title'])
                    ->body($data['body'])
                    ->create();

        return $data;
    }
}
