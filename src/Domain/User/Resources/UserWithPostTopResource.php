<?php

declare(strict_types=1);

namespace Domain\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserWithPostTopResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return [
            'id' => $this->getPost()->getId(),
            'title' => $this->getPost()->getTitle(),
            'body' => $this->getPost()->getBody(),
            'rating' => $this->getPost()->getRating(),
            'username' => $this->getName(),
            'userId' => $this->getId(),
        ];
    }
}
