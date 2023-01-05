<?php

declare(strict_types=1);

namespace Domain\User\Queries;

use Domain\User\User;
use Illuminate\Database\Eloquent\Builder;
use Domain\User\Collections\UserCollection;

class UserQueryBuilder extends Builder
{
    public function searchAllUsersWithPostTop(): UserCollection
    {
        return $this->with(['top_post'])->get();
    }

    public function searchAllOrderedByRatingWithPosts(): UserCollection
    {
        return $this->with(['posts'])->orderBy('rating')->get();
    }

    public function findByExternalId(string $id): ?User
    {
        return $this->where('external_id', $id)->limit(1)->first();
    }
}
