<?php

declare(strict_types=1);

namespace Tests\Shared\SocialMedia\Factories;

use Illuminate\Support\Str;
use Shared\SocialMedia\Events\UserSocialMediaResearched;

class UserSocialMediaResearchedFactory
{
    public static function create(
        ?int $id = null,
        ?string $uuid = null,
        ?string $name = null,
        ?string $email = null,
        ?string $city = null,
    ): UserSocialMediaResearched {
        return new UserSocialMediaResearched(
            $id     ?? 1,
            $uuid   ?? Str::uuid()->toString(),
            $name   ?? 'lolo',
            $email  ?? 'lolo@gmail.com',
            $city   ?? 'madrid',
        );
    }
}
