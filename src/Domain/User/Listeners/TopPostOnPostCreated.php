<?php

declare(strict_types=1);

namespace Domain\User\Listeners;

use Domain\Post\Events\PostCreated;
use Domain\Post\Actions\TopPostSearcherAction;
use Domain\User\Actions\UserTopPostUpdaterAction;
use Domain\Post\DataTransferObjects\FindTopPostData;
use Domain\User\DataTransferObjects\FindUserTopPostData;

class TopPostOnPostCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private UserTopPostUpdaterAction $searcher
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
        $findUserTopPostData = new FindUserTopPostData($event->userId);

        $this->searcher->__invoke($findUserTopPostData);
    }
}
