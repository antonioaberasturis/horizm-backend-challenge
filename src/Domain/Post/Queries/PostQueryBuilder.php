<?php

declare(strict_types=1);

namespace Domain\Post\Queries;

use Domain\Post\Post;
use Illuminate\Database\Eloquent\Builder;
use Domain\Post\Collections\PostCollection;

class PostQueryBuilder extends Builder
{
    public function findWithUser(string $id): ?Post
    {
        return $this
                ->with(['user'])
                ->where('id', $id)
                ->limit(1)
                ->first();
    }

    public function findByExternalId(string $id): ?Post
    {
        return $this->where('external_id', $id)->limit(1)->first();
    }

    public function searchAllPostByUserId(string $userId): PostCollection
    {
        return $this->where('user_id', $userId)->get();
    }
}
