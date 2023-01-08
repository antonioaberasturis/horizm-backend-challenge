<?php

declare(strict_types=1);

namespace Domain\Post\Actions;

use Domain\Post\DataTransferObjects\FindTopPostData;
use Domain\Post\Post;

class TopPostSearcherByUserIdAction
{
    public function __construct(
        private Post $post
    ) {
    }
    
    public function __invoke(string $userId): ?Post
    {
        /** @var Post $post */
        $post = $this->post->query()->searchTopPostByUserId($userId);

        return $post;
    }
}
