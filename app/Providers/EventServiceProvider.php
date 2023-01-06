<?php

namespace App\Providers;

use Domain\Post\Events\PostCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Shared\SocialMedia\Events\PostSocialMediaResearched;
use Shared\SocialMedia\Events\UserSocialMediaResearched;
use Domain\Post\listeners\InsertPostOnPostSocialMediaResearched;
use Domain\User\Listeners\InsertUserOnUserSocialMediaResearched;
use Domain\User\Listeners\RateUserOnPostCreated;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserSocialMediaResearched::class => [
            InsertUserOnUserSocialMediaResearched::class,
        ],
        PostSocialMediaResearched::class => [
            InsertPostOnPostSocialMediaResearched::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
