<?php

declare(strict_types=1);

namespace Domain\User\Listeners;

use Illuminate\Support\Str;
use Illuminate\Queue\InteractsWithQueue;
use Domain\User\Actions\UserCreatorAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Domain\User\DataTransferObjects\UserSocialMediaData;
use Shared\SocialMedia\Events\UserSocialMediaResearched;

class InsertUserOnUserSocialMediaResearched
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private UserCreatorAction $creator
    )
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserSocialMediaResearched $event)
    {
        $userSocialMediaData = new UserSocialMediaData(
            id:         Str::uuid()->toString(),
            externalId: (string) $event->id,
            name:       $event->name,
            email:      $event->email,
            city:       $event->city,
        );

        $this->creator->__invoke($userSocialMediaData);
    }
}
