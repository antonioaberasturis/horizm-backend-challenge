<?php

declare(strict_types=1);

namespace Tests\Application\Api;

use Domain\Post\Post;
use Domain\User\User;
use Illuminate\Support\Str;
use Domain\Post\Resources\PostByIdResource;
use Tests\Application\ApiApplicationAcceptanceTestCase;
use Tests\Application\Api\Factories\PostGetControllerResponseFactory;

class PostGetControllerTest extends ApiApplicationAcceptanceTestCase
{
    public function testShouldGetAPost(): void
    { 
        $post = PostGetControllerResponseFactory::create();

        $response = $this->get("api/posts/".$post['id']);

        $response
            ->assertStatus(200)
            ->assertExactJson($post);
    }

    public function testShouldNotFoundResourceWhenFindANotExistingPost(): void
    {
        $response = $this->get("api/posts/c44f38ed-78d7-46ec-8955-b5db9a4c7f96");

        $response->assertStatus(404);
    }
}
