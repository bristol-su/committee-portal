@component('mail::message')

Hi {{$submission->user->forename}}!

Thank you! We've just received your statement concerning {{$submission->group()->name}}'s NGB affiliation and you are
now one step closer to reaffiliating with Bristol SU!

You told us that {{$submission->group()->name}} does the following to ensure the safety standards set for your activity
are followed:

"{{$submission->statement}}"

Track your progress on the <a href="{{config('app.url')}}">Committee Portal</a>.

@endcomponent