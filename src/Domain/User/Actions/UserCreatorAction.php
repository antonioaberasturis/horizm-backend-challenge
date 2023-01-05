<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\User;
use Illuminate\Support\Str;
use Domain\User\DataTransferObjects\UserSocialMediaData;

class UserCreatorAction
{
    public function __construct(
        private User $user
    ) {  
    }

    public function __invoke(UserSocialMediaData $data): ?User
    {
        $user = $this->user->query()->findByExternalId($data->externalId);

        if(null !== $user) {
            return null;
        }

        $this->user->fill([
            'id' => $data->id,
            'external_id' => $data->externalId,
            'name' => $data->name,
            'email' => $data->email,
            'city' => $data->city,
        ]);

        $this->user->save();

        return $this->user;
    }
}
