<?php

declare(strict_types=1);

namespace Tests\Domain\User\Listeners;

use Domain\User\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Event;
use Tests\Domain\User\UserModuleTestCase;
use Domain\User\Actions\UserCreatorAction;
use Shared\SocialMedia\Events\UserSocialMediaResearched;
use Tests\Domain\User\Factories\UserSocialMediaDataFactory;
use Domain\User\Listeners\InsertUserOnUserSocialMediaResearched;
use Tests\Shared\SocialMedia\Factories\UserSocialMediaResearchedFactory;
use Tests\TestCase;

class InsertUserOnUserSocialMediaResearchedTest extends TestCase
{
    public function testShouldSubscribeToUserSocialMediaResearched(): void
    {
        Event::fake();
        
        Event::assertListening(UserSocialMediaResearched::class, InsertUserOnUserSocialMediaResearched::class);
    }

}
