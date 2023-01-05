<?php

declare(strict_types=1);

namespace Tests\Domain\User\Queries;

use Domain\Post\Post;
use Domain\User\User;
use Domain\User\Collections\UserCollection;
use Tests\Domain\User\UserModuleIntegrationTestCase;

class UserQueryBuilderTest extends UserModuleIntegrationTestCase
{
    public function testShouldSearchAllExistingUsersWithPostTop(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();
        $user->top_post()->associate($post)->save();
        $userCollection = new UserCollection([$user]);

        /** @var UserCollection response */
        $response = User::query()->searchAllUsersWithPostTop();

        $this->assertEquals($userCollection->toArray(), $response->toArray());
    }

    public function testShouldSearchEmptyWhenNotExistsUsersWithPostTop(): void
    {
        /** @var UserCollection userCollectionResponse */
        $userCollectionResponse = User::query()->searchAllUsersWithPostTop();

        $this->assertTrue($userCollectionResponse->isEmpty());
    }

    public function testShouldSearchAllUserExistingWithPosts(): void
    {
        /** @var UserCollection $userCollection */
        $userCollection = User::factory()
                        ->hasPosts(1)
                        ->count(2)
                        ->create();
        $userCollection->load('posts');

        /** @var UserCollection response */
        $response = User::query()->searchAllOrderedByRatingWithPosts();

        $this->assertEquals(
            $userCollection->sortBy('rating')->values()->toArray(), 
            $response->toArray()
        );
    }

    public function testShouldFindByExternalIdAExistingUser(): void
    {
        /** @var User user */
        $user = User::factory()->externalId('1')->create();

        /** @var User response */
        $response = User::query()->findByExternalId($user->getExternalId());

        $this->assertEquals($user->getAttributes(), $response->getAttributes());
    }

    public function testShouldNotFindByExternalIdANotExistingUser(): void
    {
        /** @var User response */
        $response = User::query()->findByExternalId('1');

        $this->assertNull($response);
    }
}
