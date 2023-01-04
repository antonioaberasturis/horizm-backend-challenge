<?php

declare(strict_types=1);

namespace Application\Api\User;

use Shared\ApiController;
use Domain\User\Actions\AllUserWithPostsSearcherAction;
use Domain\User\Resources\UserWithPostsResourceCollection;

class UsersGetController extends ApiController
{
    public function __construct(
        private AllUserWithPostsSearcherAction $searcher
    ) {  
    }

    public function __invoke()
    {
        $users = $this->searcher->__invoke();

        return response()->json(new UserWithPostsResourceCollection($users));
    }
}
