<?php

declare(strict_types=1);

namespace Domain\Post\Events;

class PostUpdated
{
    public function __construct(
        public string $id,
        public string $userId,
        public string $body,
    ) {
    }
}
