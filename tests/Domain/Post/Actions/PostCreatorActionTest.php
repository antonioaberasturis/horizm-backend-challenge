<?php

declare(strict_types=1);

namespace Tests\Domain\Post\Actions;

use Domain\Post\Post;
use Domain\User\User;
use Domain\Post\Events\PostCreated;
use Domain\Post\Events\PostUpdated;
use Illuminate\Support\Facades\Event;
use Tests\Domain\Post\PostModuleTestCase;
use Domain\Post\Actions\PostCreatorAction;
use Domain\User\Exceptions\UserNotFoundException;
use Tests\Domain\Post\Factories\PostSocialMediaDataFactory;

class PostCreatorActionTest extends PostModuleTestCase
{
    private PostCreatorAction $creator;

    public function setUp(): void
    {
        parent::setUp();
        $this->creator = new PostCreatorAction(
            $this->postModel(),
            $this->userFinderByExternalIdAction(),
            $this->postUpdaterAction()
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
        $user = User::factory()->make();

        Event::fake();
        $this->shouldMakePostQueryBuilder();
        $this->shouldFindByExternalId($postSocialMediaData->externalId);
        $this->userFinderByExternalIdAction()
        ->shouldReceive('__invoke')
        ->with($postSocialMediaData->userId)
        ->once()
        ->andReturn($user);
        $this->shouldFill(PostSocialMediaDataFactory::fromSelfAsArray($postSocialMediaData, $user));
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
    }

    public function testShouldUpdateAnExistingPost(): void
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
        $this->shouldFindByExternalId($postSocialMediaData->externalId, $post);
        
        $this->postUpdaterAction()
            ->shouldReceive('__invoke')
            ->with($post, $postSocialMediaData)
            ->once()
            ->andReturn($post);


        $response = $this->creator->__invoke($postSocialMediaData);

        $this->assertEquals($response, $post);
    }

    public function testShouldThrowUserNotFoundException(): void
    {
        $this->expectException(UserNotFoundException::class);

        $postSocialMediaData = PostSocialMediaDataFactory::create();
        
        $this->shouldMakePostQueryBuilder();
        $this->shouldFindByExternalId($postSocialMediaData->externalId);
        $this->shouldNotFindUserByExternalId($postSocialMediaData->externalId);

        $this->creator->__invoke($postSocialMediaData);
    }
}
