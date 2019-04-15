@component('mail::message')

You are receiving this email because we received a password reset request for your Committee Portal account.

@component('mail::button', ['url' => config('app.url').route('password.reset', $token, false)])
    Reset Password
@endcomponent
This password reset link will expire in {{ config('auth.passwords.users.expire') }} minutes.

If you did not request a password reset, no further action is required.


@component('mail::footer')

    If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: {{ config('app.url').route('password.reset', $token, false) }}
@endcomponent

@endcomponent