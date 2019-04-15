@component('mail::message')

Hi {{$user->forename}}!

To help with the day to day running of {{$group->name}}, it's useful for us to have committee members to contact about
various situations. {{$newPresident->forename}} has allocated you to be the main contact for notifications concerning:

@foreach($situations as $situation)
- {{$situation->title}}
@endforeach

We will not share your email address with anyone else, nor will we publish it anywhere. If you do not feel you're the
correct contact for the above notification(s), please contact {{$newPresident->forename}} as they will be able to
change it on the committee portal.

@endcomponent