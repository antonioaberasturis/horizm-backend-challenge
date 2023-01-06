<?php

declare(strict_types=1);

namespace Domain\Post\Actions;

use Domain\Post\Post;
use Domain\Post\Events\PostUpdated;
use Domain\Post\DataTransferObjects\PostSocialMediaData;

class PostUpdaterAction
{
    public function __invoke(Post $post, PostSocialMediaData $data): Post
    {
        $post->newBody($data->body);
        $post->update();

        event(new PostUpdated(
            $post->getId(),
            $post->getUserId(),
            $post->getBody(),
        ));

        return $post;
    }
}
