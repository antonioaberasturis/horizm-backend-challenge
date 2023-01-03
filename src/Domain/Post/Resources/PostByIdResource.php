<?php

declare(strict_types=1);

namespace Domain\Post\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostByIdResource extends JsonResource
{
    public function toArray($request = null)
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
            'username' => $this->getUser()->getName(),
        ];
    }
}
