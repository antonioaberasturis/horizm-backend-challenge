<?php

declare(strict_types=1);

namespace Domain\Post\Actions;

use Domain\Post\Collections\PostCollection;
use Domain\Post\Post;

class AllPostSearcherByUserIdAction
{
    public function __construct(
        private Post $post
    ) {  
    }

    public function __invoke(string $userId): PostCollection
    {
        return $this->post->searchAllPostByUserId($userId);
    }
}
