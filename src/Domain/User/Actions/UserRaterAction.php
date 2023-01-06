<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\User;
use Domain\Post\DataTransferObjects\PostData;
use Domain\Post\Actions\AllPostSearcherByUserIdAction;

class UserRaterAction
{
    public function __construct(
        private User $user,
        private AllPostSearcherByUserIdAction $allPostSearcher
    ) {   
    }

    public function __invoke(PostData $postData): User
    {
        $allPost = $this->allPostSearcher->__invoke($postData->userId);
        $userRating = (int) round($allPost->totalSumRating() / $allPost->count());

        $user = $this->user->query()->find($postData->userId);
        
        $user->setRating($userRating);
        $user->update();

        return $user;
    }
}
