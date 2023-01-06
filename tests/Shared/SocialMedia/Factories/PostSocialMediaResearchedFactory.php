<?php

declare(strict_types=1);

namespace Tests\Shared\SocialMedia\Factories;

use Illuminate\Support\Str;
use Shared\SocialMedia\Events\PostSocialMediaResearched;

class PostSocialMediaResearchedFactory
{
    public static function create(
        ?int $id = null,
        ?string $uuid = null,
        ?string $userUuid = null,
        ?string $title = null,
        ?string $body = null,
        ?int $userId = null,
        ?int $rating = null,
    ): PostSocialMediaResearched {
        return new PostSocialMediaResearched(
            $id         ?? 1,
            $uuid       ?? Str::uuid()->toString(),
            $userUuid   ?? Str::uuid()->toString(),
            $title      ?? "titulo del post",
            $body       ?? "cuerpo del post que estamos testeando",
            $userId     ?? 1,
            $rating     ?? 4,
        );
    }
}
