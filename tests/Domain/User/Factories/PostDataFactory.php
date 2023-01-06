<?php

declare(strict_types=1);

namespace Tests\Domain\User\Factories;

use Domain\Post\DataTransferObjects\PostData;
use Ramsey\Uuid\Uuid;

class PostDataFactory
{
    public static function create(
        ?string $id = null,
        ?string $userId = null,
        ?string $externalId = null,
        ?string $userExternalId = null,
        ?string $title = null,
        ?string $body = null,
        ?string $rating = null,
    ): PostData
    {
        return new PostData(
            $id             ?? Uuid::uuid4()->toString(),
            $userId         ?? Uuid::uuid4()->toString(),
            $externalId     ?? (string) random_int(1,100),
            $userExternalId ?? (string) random_int(1,10),
            $title          ?? "este es el nombre del post",
            $body           ?? "este es el body del post",
            $rating         ?? (string) random_int(1,5),
        );
    }
}
