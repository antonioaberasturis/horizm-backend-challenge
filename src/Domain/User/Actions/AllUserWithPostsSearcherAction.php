<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\Collections\UserCollection;
use Domain\User\User;

class AllUserWithPostsSearcherAction
{
    public function __construct(
        private User $user
    ) {
    }

    public function __invoke(): UserCollection
    {
        /** @var UserCollection $userCollectionWithPosts */
        $userCollectionWithPosts = $this->user->query()->searchAllOrderedByRatingWithPosts();

        return $userCollectionWithPosts;
    }
}
