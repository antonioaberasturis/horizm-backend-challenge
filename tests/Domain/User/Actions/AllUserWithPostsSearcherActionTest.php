<?php

declare(strict_types=1);

namespace Tests\Domain\User\Actions;

use Tests\Domain\User\UserModuleUnitTestCase;
use Domain\User\Actions\AllUserWithPostsSearcherAction;
use Tests\Domain\User\Factories\UserCollectionOrderedByRatingWithPostsFactory;

class AllUserWithPostsSearcherActionTest extends UserModuleUnitTestCase
{
    private AllUserWithPostsSearcherAction $searcher;

    public function setUp(): void
    {
        parent::setUp();
        $this->searcher = new AllUserWithPostsSearcherAction(
            $this->userModel()
        );
    }

    public function testShouldSearchAllUserWithPosts(): void
    {
        $userCollection = UserCollectionOrderedByRatingWithPostsFactory::create();

        $this->shouldSearchAllUserOrderedByRatingWithPosts($userCollection);

        $response = $this->searcher->__invoke();

        $this->assertEquals($userCollection->toArray(), $response->toArray());
    }
}
