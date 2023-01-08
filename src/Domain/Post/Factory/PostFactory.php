<?php

declare(strict_types=1);

namespace Domain\Post\Factory;

use Domain\Post\Post;
use Domain\User\Factory\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        
        return [
            'id' => $this->faker->uuid(),
            'external_id' => $this->faker->numberBetween(1, 100),
            'user_id' => UserFactory::class,
            'title' => $this->faker->realText(150),
            'body' => $this->faker->realText(250),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }

    public function id(string $id): static
    {
        return $this->state(fn(array $attributes) => [
                'id' => $id,
        ]);
    }

    public function userId(string $userId): static
    {
        return $this->state(fn(array $attributes) => [
                'user_id' => $userId,
        ]);
    }

    public function title(string $title): static
    {
        return $this->state(fn(array $attributes) => [
                'title' => $title,
        ]);
    }

    public function body(string $body): static
    {
        return $this->state(fn(array $attributes) => [
                'body' => $body,
        ]);
    }

    public function rating(int $rating): static
    {
        return $this->state(fn(array $attributes) => [
                'rating' => $rating,
        ]);
    }

    public function externalId(string $externalId): static
    {
        return $this->state(fn(array $attributes) => [
                'external_id' => $externalId,
        ]);
    }
}
