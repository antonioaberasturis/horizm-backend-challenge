<?php

declare(strict_types=1);

namespace Domain\User\DataTransferObjects;

class FindUserTopPostData
{
    public function __construct(
        public string $userId
    ) {   
    }

    public function userId(): string 
    {
        return $this->userId;
    }
}
