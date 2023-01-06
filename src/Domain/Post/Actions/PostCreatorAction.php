<?php

declare(strict_types=1);

namespace Domain\Post\Actions;

use Domain\Post\Post;
use Domain\Post\Events\PostCreated;
use Domain\Post\Events\PostUpdated;
use Domain\User\Exceptions\UserNotFoundException;
use Domain\User\Actions\UserFinderByExternalIdAction;
use Domain\Post\DataTransferObjects\PostSocialMediaData;

class PostCreatorAction
{
    public function __construct(
        private Post $post,
        private UserFinderByExternalIdAction $userFinder,
        private PostUpdaterAction $updater,
    ) {  
    }

    public function __invoke(PostSocialMediaData $data): ?Post
    {
        /** @var Post $post */
        $post = $this->post->query()->findByExternalId($data->externalId);

        if(null !== $post){
            return $this->updater->__invoke($post, $data);
        }

        $user = $this->userFinder->__invoke($data->userId);
        if(null === $user){
            throw new UserNotFoundException();
        }

        $this->post->fill([
            'id' => $data->id,
            'user_id' => $user->getId(),
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
