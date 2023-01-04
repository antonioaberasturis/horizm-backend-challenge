<?php

declare(strict_types=1);

namespace Tests\Domain\User\Actions;

use Tests\Domain\User\UserModuleUnitTestCase;
use Domain\User\Actions\UsersWithPostTopSearcherAction;
use Tests\Domain\User\Factories\UserCollectionWithPostTopFactory;

class UsersWithPostTopSearcherActionTest extends UserModuleUnitTestCase
{
    private UsersWithPostTopSearcherAction $searcher;

    public function setUp(): void
    {
        parent::setUp();
        $this->searcher = new UsersWithPostTopSearcherAction(
            $this->userModel()
        );
    }

    public function testShouldSearchUserCollectionWithPostTop(): void
    {
        $userCollection = UserCollectionWithPostTopFactory::create();

        $this->shouldSearchUserWithPostTop($userCollection);

        $response = $this->searcher->__invoke();

        $this->assertEquals($userCollection->toArray(), $response->toArray());
    }

    public function testShouldSearchEmptyUserCollection(): void
    {
        $userCollection = UserCollectionWithPostTopFactory::createEmpty();

        $this->shouldSearchUserWithPostTop($userCollection);

        $response = $this->searcher->__invoke();

        $this->assertTrue($response->isEmpty());
    }
}
