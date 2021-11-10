<?php

namespace App\Providers;

use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Slides\Saml2\Events\SignedIn;
use Slides\Saml2\Events\SignedOut;
// use Slides\Saml2\Facades\Auth;

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
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();


        Event::listen(\Slides\Saml2\Events\SignedIn::class, function (SignedIn $event) {
            $messageId = $event->getAuth()->getLastMessageId();

            // your own code preventing reuse of a $messageId to stop replay attacks
            $samlUser = $event->getSaml2User();

            $userData = [
                'id' => $samlUser->getUserId(),
                'attributes' => $samlUser->getAttributes(),
                'assertion' => $samlUser->getRawSamlAssertion()
            ];

            $employeeid   = $userData['attributes']["http://schemas.xmlsoap.org/ws/2005/05/identity/claims/employeeid"][0];
            $emailaddress = $userData['attributes']["http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress"][0];
            $name         = $userData['attributes']["http://schemas.microsoft.com/identity/claims/displayname"][0];

            $user = User::find($employeeid);
            if ($user == NULL) {
                $user = new User();
                $user->id = $employeeid;
                $user->name = $name;
                $user->email = $emailaddress;
                $user->password = md5(rand());
                $user->save();
            }

                // Login a user.
                Auth::login($user);

        });



        Event::listen('Slides\Saml2\Events\SignedOut', function (SignedOut $event) {
            Auth::logout();
            Session::save();
        });
        //
    }
}
