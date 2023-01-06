<?php

namespace Tests\Domain\Post\Factories;

use Domain\User\User;
use Illuminate\Support\Str;
use Domain\Post\DataTransferObjects\PostSocialMediaData;

class PostSocialMediaDataFactory
{

    public static function create(
        ?string $id = null,
        ?string $externalId = null,
        ?string $userId = null,
        ?string $title = null,
        ?string $body = null,
        ?string $rating = null,
    ): PostSocialMediaData
    {
        return new PostSocialMediaData(
            $id ?? Str::uuid()->toString(),
            $externalId ?? '1',
            $userId ?? '1',
            $title ?? 'Este es el titulo del post',
            $body ?? 'este es el cuerpo del post que estamos probando',
            $rating ?? '3',
        );
    }
    
    public static function fromSelfAsArray(PostSocialMediaData $datas, User $user): array
    {
        return [
            'id' => $datas->id,
            'external_id' => $datas->externalId,
            'user_id' => $user->getId(),
            'title' => $datas->title,
            'body' => $datas->body,
            'rating' => $datas->rating,
        ];
    }
}
