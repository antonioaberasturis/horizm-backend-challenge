<?php

declare(strict_types=1);

namespace Tests\Shared\SocialMedia\Factories;

use Shared\SocialMedia\Services\Typicode\Resources\Post;

class PostFactory
{
    public static function create(
        int $id = 1,
        int $userId = 1, 
        string $title = '',
        string $body = '',
    ): Post
    {
        return new Post([
            'id' => $id,
            'userId' => $userId,
            'title' => $title ?? "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
            "body" => $body ?? "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto",
        ]);
    }
}
