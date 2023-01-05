<?php

declare(strict_types=1);

namespace Tests\Domain\Post\Listeners;

use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Shared\SocialMedia\Events\PostSocialMediaResearched;
use Domain\Post\listeners\InsertPostOnPostSocialMediaResearched;

class InsertOnPostSocialMediaResearchedTest extends TestCase
{
    public function testShouldSubscribeToPostSocialMediaResearched(): void
    {
        Event::fake();
        
        Event::assertListening(PostSocialMediaResearched::class, InsertPostOnPostSocialMediaResearched::class);
    }
}
