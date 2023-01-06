<?php

declare(strict_types=1);

namespace Domain\User\Exceptions;

use Shared\DomainError;

class UserNotFoundException extends DomainError
{
    public function errorCode(): string
    {
        return 'user_not_found';
    }

    protected function errorMessage(): string
    {
        return 'The resource does not found';
    }
}
