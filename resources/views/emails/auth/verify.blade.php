@component('mail::message')

Hello!

Please click the button below to verify your email address and log into the Committee Portal.

@component('mail::button', ['url' => $url])
    Verify Email
@endcomponent

If you did not create an account, no further action is required.

Regards,<br/>
Bristol SU

@component('mail::footer')
    If you’re having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser: {!! $url !!}
@endcomponent

@endcomponent
