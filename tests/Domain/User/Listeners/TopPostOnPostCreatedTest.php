<?php

declare(strict_types=1);

namespace Tests\Domain\User\Listeners;

use Tests\TestCase;
use Domain\Post\Events\PostCreated;
use Illuminate\Support\Facades\Event;
use Domain\User\Listeners\TopPostOnPostCreated;

class TopPostOnPostCreatedTest extends TestCase
{
    public function testShouldSubscribeToPostCreated(): void
    {
        Event::fake();
        
        Event::assertListening(PostCreated::class, TopPostOnPostCreated::class);
    }
}
