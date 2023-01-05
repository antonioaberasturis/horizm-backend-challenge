<?php

declare(strict_types=1);

namespace Shared\SocialMedia\Services\Typicode;

use Shared\SocialMedia\Services\Typicode\Actions\Posts;
use Shared\SocialMedia\Services\Typicode\Actions\Users;
use Shared\SocialMedia\Services\Typicode\TypicodeClientInterface;

class TypicodeClient implements TypicodeClientInterface
{
    use Posts, Users;

    public function __construct(
    ) {
    }

    protected function transformCollection(array $collection, string $class): array
    {
        return array_map(function ($attributes) use ($class) {
            return new $class($attributes, $this);
        }, $collection);
    }

}
