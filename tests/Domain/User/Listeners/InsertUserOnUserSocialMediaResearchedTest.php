<?php

declare(strict_types=1);

namespace Tests\Domain\User\Listeners;

use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Shared\SocialMedia\Events\UserSocialMediaResearched;
use Domain\User\Listeners\InsertUserOnUserSocialMediaResearched;
use Tests\Shared\SocialMedia\Events\UserSocialMediaResearchedFactory;

class InsertUserOnUserSocialMediaResearchedTest extends TestCase
{
    public function testShouldSubscribeToUserSocialMediaResearched(): void
    {
        Event::fake();
        
        Event::assertListening(UserSocialMediaResearched::class, InsertUserOnUserSocialMediaResearched::class);
    }
}
