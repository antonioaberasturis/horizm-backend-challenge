<?php

namespace Tests\Domain\Post\Actions;

use Domain\Post\Post;
use Tests\Domain\Post\PostModuleTestCase;
use Domain\Post\Collections\PostCollection;
use Domain\Post\Actions\AllPostSearcherByUserIdAction;

class AllPostSearcherByUserIdActionTest extends PostModuleTestCase
{
    private AllPostSearcherByUserIdAction $searcher;

    public function setUp(): void
    {
        parent::setUp();
        $this->searcher = new AllPostSearcherByUserIdAction(
            $this->postModel()
        );
    }
    
    public function testShouldSearchAllPostsByUserId(): void
    {
        $posts = Post::factory()->count(1)->make();
        $userId = $posts->first()->getId();

        $this->shouldMakePostQueryBuilder();
        $this->postModel()
            ->shouldReceive('searchAllPostByUserId')
            ->with($userId)
            ->once()
            ->andReturn($posts);

        $response = $this->searcher->__invoke($userId);

        $this->assertEquals($posts->first(), $response->first());
    }

    public function testShouldNotSearchNotExistingPostsByUserId(): void
    {
        $posts = new PostCollection();
        $userId = '123456789';

        $this->shouldMakePostQueryBuilder();
        $this->postModel()
            ->shouldReceive('searchAllPostByUserId')
            ->with($userId)
            ->once()
            ->andReturn($posts);

        $response = $this->searcher->__invoke($userId);

        $this->assertTrue($response->isEmpty());
    }
}
