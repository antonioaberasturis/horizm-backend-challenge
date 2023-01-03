<?php

declare(strict_types=1);

namespace Tests\Domain\Post\Factories;

use Domain\Post\Post;
use Domain\Post\Resources\PostByIdResource;

class PostByIdResourceFactory
{
    public static function fromPost(Post $post): PostByIdResource
    {
        return new PostByIdResource($post);
    }
}
