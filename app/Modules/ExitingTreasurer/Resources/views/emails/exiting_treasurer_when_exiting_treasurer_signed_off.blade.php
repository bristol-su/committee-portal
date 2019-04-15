@component('mail::message')

Hi {{$user->forename}}!

Thank you! We've just received your sign-off submission for {{$group->name}} and you are
now one step closer to reaffiliating with Bristol SU!

Track your progress on the <a href="{{config('app.url')}}">Committee Portal</a>.

@endcomponent