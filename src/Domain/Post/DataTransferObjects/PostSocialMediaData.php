<?php

declare(strict_types=1);

namespace Domain\Post\DataTransferObjects;

class PostSocialMediaData
{
    public function __construct(
        public string $id,
        public string $externalId,
        public string $userId,
        public string $title,
        public string $body,
        public string $rating,
    ) {
    }
}
