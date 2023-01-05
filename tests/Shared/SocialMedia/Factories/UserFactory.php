<?php

declare(strict_types=1);

namespace Tests\Shared\SocialMedia\Factories;

use Shared\SocialMedia\Services\Typicode\Resources\User;

class UserFactory
{
    public static function create(
        int $id = 1, 
        ?string $name = null,
        ?string $email = null,
        ?string $city = null,
    ): User
    {
        return new User([
                'id' => $id ?? 1,
                'username' => $name ?? 'lolo',
                'name' => $name ?? 'lolo',
                'email' => $email ?? 'admin@gmail.com',
                'address' => [
                    'city' => $city ?? 'Madrid',
                ]
        ]);
    }
}
