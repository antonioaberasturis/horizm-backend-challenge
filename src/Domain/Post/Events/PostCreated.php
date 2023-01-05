<?php

declare(strict_types=1);

namespace Domain\Post\Events;

class PostCreated
{
    public function __construct(
        public string $id,
        public string $userId,
        public string $title,
        public string $body,
        public int $rating,
    ) {
    }
}
