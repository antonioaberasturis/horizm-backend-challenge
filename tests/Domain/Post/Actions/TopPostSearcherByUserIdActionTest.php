<?php

namespace Tests\Domain\Post\Actions;

use Domain\Post\Post;
use Domain\User\User;
use Tests\Domain\Post\PostModuleTestCase;
use Domain\Post\Actions\TopPostSearcherByUserIdAction;

class TopPostSearcherByUserIdActionTest extends PostModuleTestCase
{
    private TopPostSearcherByUserIdAction $searcher;

    public function setUp(): void
    {
        parent::setUp();
        $this->searcher = new TopPostSearcherByUserIdAction(
            $this->postModel(),
        );
    }

    public function testShouldSearchAnExistingTopPost(): void
    {
        /** @var User $user */
        $user = User::factory()->make();
        /** @var Post $post */
        $post = Post::factory()->make();

        $this->shouldMakePostQueryBuilder();
        $this->postQueryBuilder()
            ->shouldReceive('searchTopPostByUserId')
            ->with($user->getId())
            ->once()
            ->andReturn($post);

        $response = $this->searcher->__invoke($user->getId());

        $this->assertEquals($post, $response);
    }

    public function testShouldNotSearchANotExistingTopPost(): void
    {
        /** @var User $user */
        $user = User::factory()->make();

        $this->shouldMakePostQueryBuilder();
        $this->postQueryBuilder()
            ->shouldReceive('searchTopPostByUserId')
            ->with($user->getId())
            ->once()
            ->andReturn(null);

        $response = $this->searcher->__invoke($user->getId());

        $this->assertNull($response);
    }
}
