<?php

declare(strict_types=1);

namespace Tests\Application\Api;

use Domain\Post\Post;
use Domain\User\User;
use Illuminate\Testing\Assert;
use Illuminate\Support\Facades\Event;
use Domain\Post\Collections\PostCollection;
use Domain\User\Collections\UserCollection;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\Application\ApiApplicationAcceptanceTestCase;
use Tests\Application\Api\Factories\UsersGetControllerResponseFactory;
use Tests\Shared\SocialMedia\Factories\PostSocialMediaResearchedFactory;
use Tests\Shared\SocialMedia\Factories\UserSocialMediaResearchedFactory;

class UsersGetControllerTest extends ApiApplicationAcceptanceTestCase
{
    public function testShouldGetUsersWithPosts(): void
    {
        $items = [
            [User::factory()->make(), Post::factory()->rating(5)->make()],
            [User::factory()->make(), Post::factory()->rating(1)->make()]
        ];


        foreach ($items as $item) {
            /** 
             * @var Post $post 
             * @var User $user
             * */
            [$user, $post] = $item;
            $userEvent = UserSocialMediaResearchedFactory::create(
                id:     (int) $user->getExternalId(),
                uuid:   $user->getId(),
                name:   $user->getName(),
                email:  $user->getEmail(),
                city:   $user->getCity(),
            );
            $postEvent = PostSocialMediaResearchedFactory::create(
                id:         (int) $post->getExternalId(),
                uuid:       $post->getId(),
                userUuid:   $post->getUserId(),
                title:      $post->getTitle(),
                body:       $post->getBody(),
                userId:     (int) $user->getExternalId(),
                rating:     (int) $post->getRating(),
            );
            Event::dispatch($userEvent);
            Event::dispatch($postEvent);
        }
        
        $items = array_reverse($items);

        $response = $this->get("api/users");

        $response->assertStatus(200);
        
        $contents = json_decode($response->getContent(), true) ;
        
        foreach($contents as $user){
            /** @var User $expectedUser */
            $expectedUser = array_shift($items)[0];
            Assert::assertTrue($user['id'] === $expectedUser->getId());
            Assert::assertTrue($user['posts'][0]['user_id'] === $expectedUser->getId());
        }
    }
}
