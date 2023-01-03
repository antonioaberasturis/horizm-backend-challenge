<?php

declare(strict_types=1);

namespace Domain\User\Resources;

use Domain\User\Resources\UserWithPostTopResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserWithPostTopResourceCollection extends ResourceCollection
{
    public function toArray($request = null)
    {
        return UserWithPostTopResource::collection($this->collection);
    }
}
