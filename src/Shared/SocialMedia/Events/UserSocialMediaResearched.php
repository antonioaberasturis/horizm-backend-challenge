<?php

declare(strict_types=1);

namespace Shared\SocialMedia\Events;

class UserSocialMediaResearched
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $city,
    ) {
    }
}
