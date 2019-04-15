@component('mail::message')

Hi {{$submission->user->forename}}!

Thank you! We've just received your submission for the reaffiliation task allocations for {{$submission->group()->name}} and you are
now one step closer to reaffiliating with Bristol SU!

Track your progress on the <a href="{{config('app.url')}}">Committee Portal</a>.

@endcomponent