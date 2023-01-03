<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\User;
use Domain\User\Collections\UserCollection;
use Domain\User\Resources\UserWithPostTopResourceCollection;

class UsersWithPostTopSearcherAction
{
    public function __construct(
        private User $user
    ) {  
    }

    public function __invoke(): UserCollection
    {
        /** @var UserCollection $userCollectionWithPostTop */
        $userCollectionWithPostTop = $this->user->query()->searchAllUsersWithPostTop();

        return $userCollectionWithPostTop;
    }
}
