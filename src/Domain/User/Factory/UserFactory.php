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
        $faker = FakerFactory::create();

        return [
            'id' => $faker->uuid(),
            'external_id' => $faker->numberBetween(1, 100),
            'name' => $faker->name(),
            'email' => $faker->safeEmail(),
            'city' => $faker->city(),
            'rating' => $faker->numberBetween(1, 5),
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

    public function email(string $email): static
    {
        return $this->state(fn(array $attributes) => [
                'email' => $email,
        ]);
    }

    public function city(string $city): static
    {
        return $this->state(fn(array $attributes) => [
                'city' => $city,
        ]);
    }

    public function postId(string $postId): static
    {
        return $this->state(fn(array $attributes) => [
                'top_post_id' => $postId,
        ]);
    }

    public function externalId(string $externalId): static
    {
        return $this->state(fn(array $attributes) => [
                'external_id' => $externalId,
        ]);
    }
    public function rating(string $rating): static
    {
        return $this->state(fn(array $attributes) => [
                'rating' => $rating,
        ]);
    }
}
