<?php

declare(strict_types=1);

namespace Tests\Shared\SocialMedia\Factories;

use Shared\SocialMedia\Services\Typicode\Resources\Post;
use Shared\SocialMedia\Services\Typicode\Resources\PostCollection;

class PostCollectionFactory
{
    public static function create(): PostCollection
    {
        return new PostCollection([
            new Post([
                "userId" => 1,
                "id" => 1,
                "title" => "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
                "body" => "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
            ])
        ]);
    }
}
