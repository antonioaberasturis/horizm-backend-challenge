<?php

namespace Tests\Domain\User\Actions;

use Domain\Post\Post;
use Domain\User\User;
use Domain\User\Actions\UserRaterAction;
use Tests\Domain\User\UserModuleUnitTestCase;
use Tests\Domain\User\Factories\PostDataFactory;

class UserRaterActionTest extends UserModuleUnitTestCase
{
    private UserRaterAction $rater;

    public function setUp(): void
    {
        parent::setUp();
        $this->rater = new UserRaterAction(
            $this->userModel(),
            $this->allPostSearcherByUserId()
        );
    }

    public function testShouldRateUser(): void
    {
        $posts = Post::factory()->count(2)->make();
        $rating = $posts->totalSumRating() / $posts->count();
        $postData = PostDataFactory::create();
        $user = User::factory()->id($postData->userId)->rating($rating)->make();

        $this->allPostSearcherByUserId()
            ->shouldReceive('__invoke')
            ->with($postData->userId)
            ->once()
            ->andReturn($posts);
        $this->shouldMakeUserQueryBuilder();
        $this->userQueryBuilder()
            ->shouldReceive('find')
            ->with($postData->userId)
            ->once()
            ->andReturn($user);

        $response = $this->rater->__invoke($postData);

        $this->assertEquals($response, $user);
    }
}
