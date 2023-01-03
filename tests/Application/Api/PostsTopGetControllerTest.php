<?php

declare(strict_types=1);

namespace Tests\Application\Api;

use Tests\Application\ApiApplicationAcceptanceTestCase;
use Tests\Application\Api\Factories\PostsTopGetControllerResponseFactory;

class PostsTopGetControllerTest extends ApiApplicationAcceptanceTestCase
{
    public function testShouldGetTopPostsWithUser(): void
    {
        $posts = PostsTopGetControllerResponseFactory::create();

        $response = $this->get("api/posts/top");

        $response
            ->assertStatus(200)
            ->assertExactJson($posts);
    }
}
