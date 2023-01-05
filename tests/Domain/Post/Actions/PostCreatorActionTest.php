<?php

declare(strict_types=1);

namespace Tests\Domain\Post\Actions;

use Domain\Post\Post;
use Domain\Post\Events\PostCreated;
use Domain\Post\Events\PostUpdated;
use Illuminate\Support\Facades\Event;
use Tests\Domain\Post\PostModuleTestCase;
use Domain\Post\Actions\PostCreatorAction;
use Tests\Domain\Post\Factories\PostSocialMediaDataFactory;

class PostCreatorActionTest extends PostModuleTestCase
{
    private PostCreatorAction $creator;

    public function setUp(): void
    {
        parent::setUp();
        $this->creator = new PostCreatorAction(
            $this->postModel()
        );
    }

    public function testShouldInsertANewPost(): void
    {
        $postSocialMediaData = PostSocialMediaDataFactory::create();
        $post = Post::factory()
                    ->id($postSocialMediaData->id)
                    ->externalId($postSocialMediaData->externalId)
                    ->userId($postSocialMediaData->userId)
                    ->title($postSocialMediaData->title)
                    ->body($postSocialMediaData->body)
                    ->rating((int) $postSocialMediaData->rating)
                    ->make();

        Event::fake();
        $this->shouldMakePostQueryBuilder();
        $this->shouldFindByExternalId($postSocialMediaData->externalId);
        $this->shouldFill(PostSocialMediaDataFactory::fromSelfAsArray($postSocialMediaData));
        $this->shouldSave(true);

        $this->postModel()->shouldReceive([
            'getId' => $post->getId(),
            'getUserId' => $post->getUserId(),
            'getTitle' => $post->getTitle(),
            'getBody' => $post->getBody(),
            'getRating' => $post->getRating(),
        ]);
        $this->postModel()
            ->shouldReceive('getAttributes')
            ->withNoArgs()
            ->once()
            ->andReturn($post->getAttributes());

        $response = $this->creator->__invoke($postSocialMediaData);

        $this->assertEquals($post->getAttributes(), $response->getAttributes());
        Event::assertDispatched(
            PostCreated::class,
            fn(PostCreated $event) => $event->id === $postSocialMediaData->id
        );
    }

    public function testShouldUpdateAnExistingPost(): void
    {
        $postSocialMediaData = PostSocialMediaDataFactory::create();
        
        Event::fake();

        $this->shouldMakePostQueryBuilder();
        $this->shouldFindByExternalId($postSocialMediaData->externalId, $this->postModelExisting());
        $this->shouldNewBody($postSocialMediaData->body);
        $this->shouldUpdateModelExisting(true);
        $this->postModelExisting()->shouldReceive([
            'getId' => $postSocialMediaData->id,
            'getUserId' => $postSocialMediaData->userId,
            'getBody' => $postSocialMediaData->body,
            'getBody' => $postSocialMediaData->body,
        ]);

        $response = $this->creator->__invoke($postSocialMediaData);

        $this->assertEquals($postSocialMediaData->body, $response->getBody());
        Event::assertDispatched(
            PostUpdated::class,
            fn(PostUpdated $event) => $event->body === $postSocialMediaData->body
        );
    }
}
