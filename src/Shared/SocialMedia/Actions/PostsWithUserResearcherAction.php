<?php

declare(strict_types=1);

namespace Shared\SocialMedia\Actions;

use Illuminate\Support\Str;
use Shared\SocialMedia\Events\PostSocialMediaResearched;
use Shared\SocialMedia\Events\UserSocialMediaResearched;
use Shared\SocialMedia\Services\Typicode\Resources\Post;
use Shared\SocialMedia\Services\Typicode\TypicodeClientInterface;
use Shared\SocialMedia\Services\Typicode\Resources\PostCollection;

class PostsWithUserResearcherAction
{
    public function __construct(
        private TypicodeClientInterface $typicodeService,
        private PostRatingCalculatorAction $ratingCalculator
    ) {  
    }
    public function __invoke(): void
    {
        /** @var PostCollection $posts */
        $posts = $this->typicodeService->posts(1, 50);

        /** @var Post $post */
        foreach ($posts->all() as $post) {
            $user = $this->typicodeService->user($post->userId);
            
            $userUuid = Str::uuid()->toString();
            event(new UserSocialMediaResearched(
                id:     $user->id,
                uuid:   $userUuid,
                name:   $user->name,
                email:  $user->email,
                city:   $user->address->city,
            ));
            $postUuid = Str::uuid()->toString();
            \Log::info('user:post', ["{$userUuid}:{$postUuid}"]);
            event(new PostSocialMediaResearched(
                id:         $post->id,
                uuid:       $postUuid,
                userUuid:   $userUuid,
                title:      $post->title,
                body:       $post->body,
                userId:     $post->userId,
                rating:     $this->ratingCalculator->__invoke($post)
            ));
        }
    }
}
