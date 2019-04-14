@component('mail::message')

Hi {{$unionCloudStudent->forename}}!

You've just been added by {{$newPresident->forename}} {{$newPresident->surname}} to the 2019/20 committee for {{$group->name}}.

You can now register on the Committee Portal to see your group's progress towards reaffiliating with Bristol SU.

@endcomponent