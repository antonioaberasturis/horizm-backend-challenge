<?php

declare(strict_types=1);

namespace Domain\Post\Queries;

use Domain\Post\Post;
use Illuminate\Database\Eloquent\Builder;

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
}
