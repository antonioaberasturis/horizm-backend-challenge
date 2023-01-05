<?php

declare(strict_types=1);

namespace Shared\SocialMedia\Services\Typicode\Actions;

use Illuminate\Support\Facades\Http;
use Shared\SocialMedia\Services\Typicode\Resources\User;

trait Users
{
    public function user(int $id): User
    {
        $response = Http::get("https://jsonplaceholder.typicode.com/users/{$id}");

        return new User($response->json(), $this);
    }
}
