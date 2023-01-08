<?php

namespace Tests\Domain\Post\Queries;

use Domain\Post\Post;
use Domain\User\User;
use Domain\Post\Collections\PostCollection;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
    
    public function testShouldFindByExternalIdAnExistingPost(): void
    {

        /** @var Post post */
        $post = Post::factory()->forUser()->externalId('1')->create();

        /** @var Post response */
        $response = Post::query()->findByExternalId($post->getExternalId());

        $this->assertEquals($post->getAttributes(), $response->getAttributes());
    }

    public function testShouldNotFindByExternalIdANotExistingUser(): void
    {
        /** @var Post response */
        $response = Post::query()->findByExternalId('1');

        $this->assertNull($response);
    }

    public function testShouldSearchAllExistingPostByUserId(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var PostCollection $posts */
        $posts = Post::factory()->for($user)->count(1)->create();

        /** @var PostCollection $response */
        $response = Post::query()->searchAllPostByUserId($user->getId());

        $this->assertEquals($posts->count(), $response->count());
        $this->assertTrue($posts->first()->is($response->first()));
    }

    public function testShouldNotSearchAllNotExistingPostByUserId(): void
    {
        /** @var User $user */
        $user = User::factory()->make();

        /** @var PostCollection $response */
        $response = Post::query()->searchAllPostByUserId($user->getId());

        $this->assertTrue($response->isEmpty());
    }

    public function testShouldSearchExistingTopPost(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Post $post1 */
        $post1 = Post::factory()->for($user)->rating(1)->create();
        /** @var Post $post2 */
        $post2 = Post::factory()->for($user)->rating(5)->create();

        /** @var Post $response */
        $response = Post::query()->searchTopPostByUserId($user->getId());

        $this->assertEquals($post2->getId(), $response->getId());
    }

    public function testShouldNotSearchNotExistingTopPost(): void
    {
        /** @var User $user */
        $user = User::factory()->make();

        /** @var Post $response */
        $response = Post::query()->searchTopPostByUserId($user->getId());

        $this->assertNull($response);
    }
}
