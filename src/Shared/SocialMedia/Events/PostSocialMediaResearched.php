<?php

declare(strict_types=1);

namespace Shared\SocialMedia\Events;

class PostSocialMediaResearched
{
    public function __construct(
        public int $id,
        public string $uuid,
        public string $userUuid,
        public string $title,
        public string $body,
        public int $userId,
        public int $rating,
    ) {
    }
}
