<?php

declare(strict_types=1);

namespace Tests\Domain\User\Actions;

use Domain\Post\Post;
use Domain\User\User;
use Tests\Domain\User\UserModuleUnitTestCase;
use Domain\User\Actions\UserTopPostUpdaterAction;
use Domain\User\DataTransferObjects\FindUserTopPostData;

class UserTopPostUpdaterActionTest extends UserModuleUnitTestCase
{
    private UserTopPostUpdaterAction $updater;

    public function setUp(): void
    {
        parent::setUp();
        $this->updater = new UserTopPostUpdaterAction(
            $this->userModel(),
            $this->topPostSearcherByUserId()
        );
    }

    public function testShouldUpdateExistingTopPost(): void
    {
        $user = User::factory()->make();
        $post = Post::factory()->make();
        $findUserTopPostData = new FindUserTopPostData($user->getId());
        
        
        $this->topPostSearcherByUserId()
            ->shouldReceive('__invoke')
            ->with($findUserTopPostData->userId())
            ->once()
            ->andReturn($post);
        
        $this->userExisting()
            ->shouldReceive('setTopPostId')
            ->with($post->getId())
            ->once()
            ->andReturnNull();
        $this->userExisting()
            ->shouldReceive('update')
            ->withNoArgs()
            ->once()
            ->andReturn(true);
        $this->userExisting()
            ->shouldReceive('getTopPostId')
            ->withNoArgs()
            ->once()
            ->andReturn($post->getId());

        $this->shouldMakeUserQueryBuilder();
        $this->userQueryBuilder()
            ->shouldReceive('find')
            ->with($findUserTopPostData->userId())
            ->once()
            ->andReturn($this->userExisting());
        
        $response = $this->updater->__invoke($findUserTopPostData);

        $this->assertEquals($post->getId(), $response->getTopPostId());
        
    }

    public function testShouldNotUpdateANotExistingTopPost(): void
    {
        $user = User::factory()->make();
        $findUserTopPostData = new FindUserTopPostData($user->getId());
        
        $this->topPostSearcherByUserId()
            ->shouldReceive('__invoke')
            ->with($findUserTopPostData->userId())
            ->once()
            ->andReturn(null);
        
        $response = $this->updater->__invoke($findUserTopPostData);

        $this->assertNull($response);
    }

}
