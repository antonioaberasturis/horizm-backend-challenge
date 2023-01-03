<?php

declare(strict_types=1);

namespace Domain\Post\Factory;

use Domain\Post\Post;
use Domain\User\Factory\UserFactory;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'id' => FakerFactory::create()->uuid(),
            'user_id' => UserFactory::class,
            'title' => FakerFactory::create()->realText(150),
            'body' => FakerFactory::create()->realText(250),
            'rating' => FakerFactory::create()->numberBetween(1, 5),
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
}
