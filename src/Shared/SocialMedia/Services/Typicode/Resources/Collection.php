<?php

declare(strict_types=1);

namespace Shared\SocialMedia\Services\Typicode\Resources;

abstract class Collection
{
    public function __construct(
        private array $items = []
    ) {
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function all(): array
    {
        return $this->items;
    }
}
