<?php

declare(strict_types=1);

namespace Application\Api\Post;

use Shared\ApiController;
use Domain\User\Actions\UsersWithPostTopSearcherAction;
use Domain\User\Resources\UserWithPostTopResourceCollection;

class PostsTopGetController extends ApiController
{
    public function __construct(
        private UsersWithPostTopSearcherAction $searcher
    ) {
    }

    public function __invoke()
    {
        $userCollectionWithPostTop = $this->searcher->__invoke();

        return response()->json(new UserWithPostTopResourceCollection($userCollectionWithPostTop));
    }
}
