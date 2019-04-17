@component('mail::message')

    Hi {{$submission->user->forename}}!

    Thank you! We've just received your confirmation for reading our GDPR for student leaders guidance and {{$submission->group()->name}} is
    now one step closer to reaffiliating with Bristol SU!

    Track your progress on the <a href="{{config('app.url')}}">Committee Portal</a>.

@endcomponent