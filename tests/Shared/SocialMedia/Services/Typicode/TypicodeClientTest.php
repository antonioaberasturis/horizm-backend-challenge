<?php

namespace Tests\Shared\SocialMedia\Services\Typicode;

use Shared\SocialMedia\Services\Typicode\TypicodeClientInterface;
use Tests\TestCase;

class TypicodeClientTest extends TestCase
{
    public function testShouldGetAUser(): void
    {
        /** @var TypicodeClientInterface $client */
        $client = app()->make(TypicodeClientInterface::class);

        $user = $client->user(1);

        $this->assertEquals($user->id, 1);
    }

    public function testShouldGetPosts(): void
    {
        /** @var TypicodeClientInterface $client */
        $client = app()->make(TypicodeClientInterface::class);

        $posts = $client->posts(1, 50);

        $this->assertEquals(50, $posts->count());
    }

    public function testShouldGetPost(): void
    {
        /** @var TypicodeClientInterface $client */
        $client = app()->make(TypicodeClientInterface::class);

        $post = $client->post(1);

        $this->assertEquals($post->id, 1);
    }
}
