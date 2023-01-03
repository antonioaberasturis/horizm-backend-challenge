<?php

declare(strict_types=1);

namespace Domain\User\Queries;

use Illuminate\Database\Eloquent\Builder;
use Domain\User\Collections\UserCollection;

class UserQueryBuilder extends Builder
{
    public function searchAllUsersWithPostTop(): UserCollection
    {
        return $this->with(['top_post'])->get();
    }
}
