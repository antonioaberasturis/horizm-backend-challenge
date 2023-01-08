<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\User;
use Domain\Post\Actions\TopPostSearcherByUserIdAction;
use Domain\User\DataTransferObjects\FindUserTopPostData;

class UserTopPostUpdaterAction
{
    public function __construct(
        private User $user,
        private TopPostSearcherByUserIdAction $topPostSearcher,
    ) {
    }

    public function __invoke(FindUserTopPostData $findUserTopPostData): ?User
    {
        $post = $this->topPostSearcher->__invoke($findUserTopPostData->userId());
        
        if(null === $post){
            return null;
        }

        /** @var User $user */
        $user = $this->user->query()->find($findUserTopPostData->userId());
        $user->setTopPostId($post->getId());
        $user->update();

        return $user;
    }
}
