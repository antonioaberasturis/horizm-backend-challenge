<?php

namespace Tests\Domain\Post\Queries;

use Domain\Post\Post;
use Domain\User\User;
use Tests\Domain\Post\PostModuleIntegrationTestCase;

class PostQueryBuilderTest extends PostModuleIntegrationTestCase
{

    public function testShouldFindAnExistingPostWithUser(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Post $post */
        $post = Post::factory()->for($user)->create();
        
        /** @var Post $postResponse */
        $postResponse = Post::query()->findWithUser($post->getId());

        $this->assertTrue($post->is($postResponse));
        $this->assertTrue($postResponse->relationLoaded('user'));
        $this->assertTrue($user->is($postResponse->getRelationValue('user')));
    }

    public function testShouldNotFindANotExistingPostWithUser(): void
    {
        /** @var Post $postResponse */
        $postResponse = (new Post)->query()->findWithUser('c44f38ed-78d7-46ec-8955-b5db9a4c7f96');

        $this->assertNull($postResponse);
    }
}
