<?php

declare(strict_types=1);

namespace Domain\User\Factory;

use Domain\Post\Factory\PostFactory;
use Domain\User\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'id' => FakerFactory::create()->uuid(),
            'name' => FakerFactory::create()->name(),
            'email' => FakerFactory::create()->safeEmail(),
            'city' => FakerFactory::create()->city(),
            'rating' => FakerFactory::create()->numberBetween(1, 5),
            'top_post_id' => PostFactory::class,
        ];
    }

    public function id(string $id): static
    {
        return $this->state(fn(array $attributes) => [
                'id' => $id,
        ]);
    }

    public function name(string $name): static
    {
        return $this->state(fn(array $attributes) => [
                'name' => $name,
        ]);
    }
}
