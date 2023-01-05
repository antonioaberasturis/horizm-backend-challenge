<?php

declare(strict_types=1);

namespace Domain\Post\listeners;

use Illuminate\Support\Str;
use Domain\Post\Actions\PostCreatorAction;
use Domain\Post\DataTransferObjects\PostSocialMediaData;
use Shared\SocialMedia\Events\PostSocialMediaResearched;

class InsertPostOnPostSocialMediaResearched
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private PostCreatorAction $creator
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
    public function handle(PostSocialMediaResearched $event)
    {
        $postSocialMediaData = new PostSocialMediaData(
            id:         Str::uuid()->toString(),
            externalId: (string) $event->id,
            userId:     (string) $event->userId,
            title:      $event->title,
            body:       $event->body,
            rating:     (string) $event->rating,
        );

        $this->creator->__invoke($postSocialMediaData);
    }
}
