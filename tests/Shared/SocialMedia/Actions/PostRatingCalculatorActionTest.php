<?php

declare(strict_types=1);

namespace Tests\Shared\SocialMedia\Actions;

use Tests\Shared\SocialMedia\Factories\PostFactory;
use Shared\SocialMedia\Actions\PostRatingCalculatorAction;
use Tests\Shared\SocialMedia\SocialMediaModuleUnitTestCase;

class PostRatingCalculatorActionTest extends SocialMediaModuleUnitTestCase
{
    public function testShouldCalculatePostRating(): void
    {
        $post = PostFactory::create();
        /** @var PostRatingCalculatorAction $calculator */
        $calculator = app()->make(PostRatingCalculatorAction::class);

        $this->assertEquals(1.28, $calculator->__invoke($post));
    }
}
