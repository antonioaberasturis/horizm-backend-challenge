<?php

declare(strict_types=1);

namespace Domain\Post\DataTransferObjects;

class FindPostData
{
    public function __construct(
        private string $id
    ) {  
    }

    public function id(): string
    {
        return $this->id;
    }
}
