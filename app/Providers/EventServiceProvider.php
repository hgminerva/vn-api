<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use Aacotroneo\Saml2\Events\Saml2LoginEvent;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('Aacotroneo\Saml2\Events\Saml2LoginEvent', function (Saml2LoginEvent $event) {
            $messageId = $event->getSaml2Auth()->getLastMessageId();
            $user = $event->getSaml2User();
            $userData = [
                'id' => $user->getUserId(),
                'attributes' => $user->getAttributes(),
                'assertion' => $user->getRawSamlAssertion()
            ];

            //redirect()->route('/');
            //session(['user'=>'hi']);

            $authenticated_user = User::where('username', 'sso')->first();
            Auth::guard('web')->login($authenticated_user, true);

            sleep(3);

            $id = $user->getUserId();
            header("Location: https://gs-vaccinetracker.pinnaclecare.com/security/sso?id=".$id);
            die();
        });
    }
}
