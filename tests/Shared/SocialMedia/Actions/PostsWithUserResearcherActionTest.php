<?php

declare(strict_types=1);

namespace Tests\Shared\SocialMedia\Actions;


use Illuminate\Support\Facades\Event;
use Tests\Shared\SocialMedia\Factories\UserFactory;
use Shared\SocialMedia\Events\PostSocialMediaResearched;
use Shared\SocialMedia\Events\UserSocialMediaResearched;
use Shared\SocialMedia\Services\Typicode\Resources\Post;
use Tests\Shared\SocialMedia\SocialMediaModuleUnitTestCase;
use Shared\SocialMedia\Actions\PostsWithUserResearcherAction;
use Tests\Shared\SocialMedia\Factories\PostCollectionFactory;

class PostsWithUserResearcherActionTest extends SocialMediaModuleUnitTestCase
{
    private PostsWithUserResearcherAction $researcher;

    public function setUp(): void 
    {
        parent::setUp();
        
        $this->researcher = new PostsWithUserResearcherAction(
                                $this->typicodeService()
                            );
    }

    public function testShouldResearchExistingPostsWithUser(): void
    {
        Event::fake();

        $user = UserFactory::create(1);
        $posts = PostCollectionFactory::create();
        /** @var Post  $post */
        $post = $posts->all()[0];

        $this->shouldGetPosts($posts);
        $this->shouldGetUser($post->userId, $user);

        $this->researcher->__invoke(); 
        
        Event::assertDispatched(
            UserSocialMediaResearched::class, 
            function (UserSocialMediaResearched $event)use($user){
                return $event->id === $user->id;
            });
        Event::assertDispatched(
            PostSocialMediaResearched::class, 
            function (PostSocialMediaResearched $event)use($post){
                return $event->id === $post->id;
            }
        );
    }
}
