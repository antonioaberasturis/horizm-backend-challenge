<?php

declare(strict_types=1);

namespace Tests\Domain\Post\Actions;

use Domain\Post\Post;
use Domain\User\User;
use Tests\Domain\Post\PostModuleUnitTestCase;
use Domain\Post\Exeptions\PostNotFoundException;
use Domain\Post\Actions\PostWithUserFinderAction;
use Tests\Domain\Post\Factories\FindPostDataFactory;
use Tests\Domain\Post\Factories\PostByIdResourceFactory;

class PostWithUserFinderActionTest extends PostModuleUnitTestCase
{
    private PostWithUserFinderAction $finder;

    public function setUp(): void
    {
        parent::setUp();
        $this->finder = new PostWithUserFinderAction(
            $this->postModel()
        );
    }

    public function testShouldFindAPostWithUser(): void
    {
        $findPostData = FindPostDataFactory::create();

        $user = User::factory()->make();
        $post = Post::factory()->id($findPostData->id())->userId($user->getId())->make();
        $post->setRelation('user', $user);
        $postByIdResrouce = PostByIdResourceFactory::fromPost($post);

        $this->shouldFindWithUser($findPostData->id(), $post);

        $resource = $this->finder->__invoke($findPostData);

        $this->assertEquals($findPostData->id(), $resource->toArray()['id']);
        $this->assertEquals($postByIdResrouce->toArray(), $resource->toArray());
    }

    public function testShouldThrowExceptionWhenFindNotExistingPost(): void
    {
        $this->expectException(PostNotFoundException::class);

        $findPostData = FindPostDataFactory::create();

        $this->shouldFindWithUser($findPostData->id());

        $this->finder->__invoke($findPostData);
    }
    
}
