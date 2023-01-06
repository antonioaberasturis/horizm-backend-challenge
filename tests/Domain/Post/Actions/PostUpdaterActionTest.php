<?php

declare(strict_types=1);

namespace Tests\Domain\Post\Actions;

use Domain\Post\Post;
use Domain\Post\Events\PostUpdated;
use Illuminate\Support\Facades\Event;
use Tests\Domain\Post\PostModuleTestCase;
use Domain\Post\Actions\PostUpdaterAction;
use Tests\Domain\Post\Factories\PostSocialMediaDataFactory;

class PostUpdaterActionTest extends PostModuleTestCase
{
    private PostUpdaterAction $updater;

    public function setUp(): void
    {
        parent::setUp();
        $this->updater = new PostUpdaterAction();
    }

    public function testShouldUpdateAnExistingPost(): void
    {
        $postSocialMediaData = PostSocialMediaDataFactory::create();

        Event::fake();
        $this->shouldNewBody($postSocialMediaData->body);
        $this->shouldUpdateModelExisting(true);
        $this->postModelExisting()->shouldReceive([
            'getId' => $postSocialMediaData->id,
            'getUserId' => $postSocialMediaData->userId,
            'getBody' => $postSocialMediaData->body,
            'getBody' => $postSocialMediaData->body,
        ]);

        $response = $this->updater->__invoke($this->postModelExisting(), $postSocialMediaData);

        $this->assertEquals($postSocialMediaData->body, $response->getBody());
        Event::assertDispatched(
            PostUpdated::class,
            fn(PostUpdated $event) => $event->body === $postSocialMediaData->body
        );
    }
}
