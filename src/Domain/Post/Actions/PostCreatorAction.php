<?php

declare(strict_types=1);

namespace Domain\Post\Actions;

use Domain\Post\Post;
use Domain\Post\Events\PostUpdated;
use Domain\Post\DataTransferObjects\PostSocialMediaData;
use Domain\Post\Events\PostCreated;

class PostCreatorAction
{
    public function __construct(
        private Post $post
    ) {  
    }

    public function __invoke(PostSocialMediaData $data): ?Post
    {
        /** @var Post $post */
        $post = $this->post->query()->findByExternalId($data->externalId);

        if(null !== $post) {
            $post->newBody($data->body);
            $post->update();

            event(new PostUpdated(
                $post->getId(),
                $post->getUserId(),
                $post->getBody(),
            ));

            return $post;
        }

        $this->post->fill([
            'id' => $data->id,
            'user_id' => $data->userId,
            'external_id' => $data->externalId,
            'title' => $data->title,
            'body' => $data->body,
            'rating' => $data->rating,
        ]);

        $this->post->save();

        event(new PostCreated(
            $this->post->getId(),
            $this->post->getUserId(),
            $this->post->getTitle(),
            $this->post->getBody(),
            $this->post->getRating(),
        ));

        return $this->post;
    }
}
