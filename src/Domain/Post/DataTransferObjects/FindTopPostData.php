<?php

declare(strict_types=1);

namespace Domain\Post\DataTransferObjects;

class FindTopPostData
{
    public function __construct(
        private string $userId
    ) {  
    }

    public function userId(): string
    {
        return $this->userId;
    }
}
