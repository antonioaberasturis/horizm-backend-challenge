<?php

declare(strict_types=1);

namespace Shared\SocialMedia\Services\Typicode\Resources;

class Post extends ApiResource
{
    public int $id;
    public string $title;
    public string $body;
    public int $userId;

    public function user(): User
    {
        return $this->client->user($this->userId);
    }
}
