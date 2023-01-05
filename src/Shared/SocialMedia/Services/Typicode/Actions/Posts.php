<?php

declare(strict_types=1);

namespace Shared\SocialMedia\Services\Typicode\Actions;

use Illuminate\Support\Facades\Http;
use Shared\SocialMedia\Services\Typicode\Resources\Post;
use Shared\SocialMedia\Services\Typicode\Resources\PostCollection;

trait Posts
{
    public function posts(int $page = 1, int $count = 50): PostCollection
    {
        $response = Http::get("https://jsonplaceholder.typicode.com/posts")
                        ->collect()
                        ->forPage($page, $count);

        return new PostCollection($this->transformCollection($response->all(), Post::class));
    }

    public function post(int $id): Post
    {
        $response = Http::get("https://jsonplaceholder.typicode.com/posts/{$id}");

        return new Post($response->json(), $this);
    }
}
