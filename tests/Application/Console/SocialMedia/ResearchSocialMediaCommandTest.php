<?php

declare(strict_types=1);

namespace Tests\Application\Console\SocialMedia;

use Illuminate\Support\Facades\Event;
use Shared\SocialMedia\Events\PostSocialMediaResearched;
use Shared\SocialMedia\Events\UserSocialMediaResearched;
use Tests\Application\ConsoleApplicationAcceptanceTestCase;

class ResearchSocialMediaCommandTest extends ConsoleApplicationAcceptanceTestCase
{
    public function testShouldResearchSocialMedia(): void
    {
        Event::fake();
        $this->artisan('socialmedia:research')->assertSuccessful();
        Event::assertDispatched(UserSocialMediaResearched::class, );
        Event::assertDispatched(PostSocialMediaResearched::class);
    }
}
