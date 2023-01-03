<?php

declare(strict_types=1);

namespace Domain\Post\Actions;

use Domain\Post\Post;
use Domain\Post\Resources\PostByIdResource;
use Domain\Post\Exeptions\PostNotFoundException;
use Domain\Post\DataTransferObjects\FindPostData;

class PostWithUserFinderAction
{
    public function __construct(
        private Post $post
    ) {
    }
    public function __invoke(FindPostData $data): ?Post
    {
        /** @var Post $post */
        $post = $this->post->query()->findWithUser($data->id());

        if(null === $post) {
            throw new PostNotFoundException();
        }

        return $post;
    }
}
