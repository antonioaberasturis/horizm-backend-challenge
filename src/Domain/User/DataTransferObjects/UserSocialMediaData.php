<?php

declare(strict_types=1);

namespace Domain\User\DataTransferObjects;

class UserSocialMediaData
{
    public function __construct(
        public string $id,
        public string $externalId,
        public string $name,
        public string $email,
        public string $city,
    ) {
    }
}
