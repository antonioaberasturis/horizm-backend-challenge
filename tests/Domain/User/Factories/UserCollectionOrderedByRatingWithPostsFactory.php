<?php

namespace Tests\Domain\User\Factories;

use Domain\Post\Post;
use Domain\User\User;
use Domain\User\Collections\UserCollection;

class UserCollectionOrderedByRatingWithPostsFactory
{
    public static function create(): UserCollection
    {

        /** @var UserCollection $users */
        $users = User::factory()
                    ->has(Post::factory())
                    ->count(2)
                    ->make();
        
        return $users->sortBy('rating')
                    ->values();
    }
}
