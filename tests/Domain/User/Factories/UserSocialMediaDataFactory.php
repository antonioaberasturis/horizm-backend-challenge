<?php

declare(strict_types=1);

namespace Tests\Domain\User\Factories;

use Illuminate\Support\Str;
use Domain\User\DataTransferObjects\UserSocialMediaData;

class UserSocialMediaDataFactory
{

    public static function create(
        ?string $id = null,
        ?string $externalId = null,
        ?string $name = null,
        ?string $email = null,
        ?string $city = null,
    ): UserSocialMediaData
    {
        return new UserSocialMediaData(
            $id ?? Str::uuid()->toString(),
            $externalId ?? '1',
            $name ?? 'lolo',
            $email ?? 'lolo@gmail.com',
            $city ?? 'madrid',
        );
    }
    public static function fromSelfAsArray(UserSocialMediaData $datas): array
    {
        return [
            'id' => $datas->id,
            'external_id' => $datas->externalId,
            'name' => $datas->name,
            'email' => $datas->email,
            'city' => $datas->city,
        ];
    }

}
