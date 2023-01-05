<?php

declare(strict_types=1);

namespace Shared\SocialMedia\Actions;

use Shared\SocialMedia\Events\PostSocialMediaResearched;
use Shared\SocialMedia\Events\UserSocialMediaResearched;
use Shared\SocialMedia\Services\Typicode\Resources\Post;
use Shared\SocialMedia\Services\Typicode\TypicodeClientInterface;
use Shared\SocialMedia\Services\Typicode\Resources\PostCollection;

class PostsWithUserResearcherAction
{
    public function __construct(
        private TypicodeClientInterface $typicodeService
    ) {  
    }
    public function __invoke(): void
    {
        /** @var PostCollection $posts */
        $posts = $this->typicodeService->posts(1, 50);

        /** @var Post $post */
        foreach ($posts->all() as $post) {
            $user = $this->typicodeService->user($post->userId);

            event(new UserSocialMediaResearched(
                id:     $user->id,
                name:   $user->name,
                email:  $user->email,
                city:   $user->address->city,
            ));

            event(new PostSocialMediaResearched(
                id:     $post->id,
                title:  $post->title,
                body:   $post->body,
                userId: $post->userId,
            ));
        }
    }
}
