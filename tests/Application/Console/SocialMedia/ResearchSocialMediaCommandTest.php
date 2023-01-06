<?php

declare(strict_types=1);

namespace Tests\Application\Console\SocialMedia;

use Tests\Application\ConsoleApplicationAcceptanceTestCase;

class ResearchSocialMediaCommandTest extends ConsoleApplicationAcceptanceTestCase
{
    public function testShouldResearchSocialMedia(): void
    {
        $this->artisan('socialmedia:research')->assertSuccessful();
    }
}
