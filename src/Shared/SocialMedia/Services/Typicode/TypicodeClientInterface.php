<?php

declare(strict_types=1);

namespace Shared\SocialMedia\Services\Typicode;

use Shared\SocialMedia\Services\Typicode\Resources\Post;
use Shared\SocialMedia\Services\Typicode\Resources\User;
use Shared\SocialMedia\Services\Typicode\Resources\PostCollection;

interface TypicodeClientInterface
{
    public function posts(int $page, int $count): PostCollection;

    public function user(int $id): User;

    public function post(int $id): Post;
}
