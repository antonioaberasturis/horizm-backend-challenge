<?php

namespace Tests\Domain\User\Factories;

use Faker\Factory;
use Domain\Post\Post;
use Domain\User\User;
use Domain\User\Collections\UserCollection;

class UserCollectionWithPostTopFactory
{
    public static function create(): UserCollection
    {
        $postId = Factory::create()->uuid();
        $user = User::factory()->postId($postId)->make();
        $post = Post::factory()->id($postId)->userId($user->getId())->make();
        $user->setRelation('top_post', $post);
        $userCollection = new UserCollection([$user]);

        return $userCollection;
    }

    public static function createEmpty(): UserCollection
    {
        return new UserCollection([]);
    }
}
