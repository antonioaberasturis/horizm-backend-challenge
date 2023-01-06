<?php

declare(strict_types=1);

namespace Domain\Post\DataTransferObjects;

class PostData
{
    public function __construct(
        public string $id,
        public string $userId,
        public string $externalId,
        public string $userExternalId,
        public string $title,
        public string $body,
        public string $rating,
    ) {
    }
}
