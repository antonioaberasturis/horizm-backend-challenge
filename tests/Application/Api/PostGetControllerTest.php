<?php

declare(strict_types=1);

namespace Tests\Application\Api;

use Domain\Post\Post;
use Domain\User\User;
use Illuminate\Support\Str;
use Domain\Post\Resources\PostByIdResource;
use Illuminate\Support\Facades\Event;
use Tests\Application\ApiApplicationAcceptanceTestCase;
use Tests\Application\Api\Factories\PostGetControllerResponseFactory;
use Tests\Shared\SocialMedia\Factories\PostSocialMediaResearchedFactory;
use Tests\Shared\SocialMedia\Factories\UserSocialMediaResearchedFactory;

class PostGetControllerTest extends ApiApplicationAcceptanceTestCase
{
    public function testShouldGetAPost(): void
    { 
        $user = UserSocialMediaResearchedFactory::create();
        $post = PostSocialMediaResearchedFactory::create(
            userId: $user->id,
        );
        Event::dispatch($user);
        Event::dispatch($post);

        $response = $this->get("api/posts/".$post->uuid);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                "id" => $post->uuid,
                "title" => $post->title,
                "body" => $post->body,
                "username" => $user->name,
            ]);
    }

    public function testShouldNotFoundResourceWhenFindANotExistingPost(): void
    {
        $response = $this->get("api/posts/c44f38ed-78d7-46ec-8955-b5db9a4c7f96");

        $response->assertStatus(404);
    }
}
