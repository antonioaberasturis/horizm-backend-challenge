<?php

declare(strict_types=1);

namespace Domain\User\Listeners;

use Domain\Post\Events\PostCreated;
use Domain\User\Actions\UserRaterAction;
use Domain\Post\DataTransferObjects\PostData;

class RateUserOnPostCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private UserRaterAction $rater
    ) {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $postData = new PostData(
            id:             $event->id,
            userId:         $event->userId,
            externalId:     '',
            userExternalId: '',
            title:          $event->title,
            body:           $event->body,
            rating:         (string) $event->rating,
        );

        $this->rater->__invoke($postData);
    }
}
