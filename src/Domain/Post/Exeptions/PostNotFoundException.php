<?php

namespace Domain\Post\Exeptions;

use Shared\DomainError;

class PostNotFoundException extends DomainError
{
    public function errorCode(): string
    {
        return 'post_not_found';
    }

    protected function errorMessage(): string
    {
        return 'The resource does not found';
    }
}
