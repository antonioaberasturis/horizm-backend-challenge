<?php

declare(strict_types=1);

namespace Domain\User\Resources;

use Domain\Post\Resources\PostResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'city' => $this->getCity(),
            'posts' => PostResource::collection($this->getPosts()),
        ];
    }
}
