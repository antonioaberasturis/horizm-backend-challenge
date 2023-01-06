<?php

declare(strict_types=1);

namespace Tests\Domain\User\Listeners;

use Domain\Post\Events\PostCreated;
use Domain\User\Listeners\RateUserOnPostCreated;
use Illuminate\Support\Facades\Event;
use Tests\Domain\User\UserModuleUnitTestCase;
use Tests\TestCase;

class RateUserOnPostCreatedTest extends TestCase
{
    public function testShouldSubscribeToPostCreated(): void
    {
        Event::fake();
        
        Event::assertListening(PostCreated::class, RateUserOnPostCreated::class);
    }
}
