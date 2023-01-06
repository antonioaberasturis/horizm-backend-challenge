<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\User;

class UserFinderByExternalIdAction
{
    public function __construct(
        private User $user
    ) {  
    }

    public function __invoke(string $externalId): ?User
    {
        return $this->user->query()->findByExternalId($externalId);
    }
}
