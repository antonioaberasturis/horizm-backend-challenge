<?php

declare(strict_types=1);

namespace Domain\User\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserWithPostsResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return UserResource::collection($this->collection);
    }
}
