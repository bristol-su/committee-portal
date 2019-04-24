@component('mail::message')

Hi {{$user->forename}}!

In order for {{$group->name}} to reaffiliate, several tasks must be completed. {{$newPresident->forename}} has allocated you
to be responsible for the following @if($tasks->count() === 1) task: @else tasks: @endif

@foreach($tasks as $task)
- {{$task->title}}
@endforeach

Please register on the <a href="{{config('app.url')}}">Committee portal</a> if you have not done so. You can find all
tasks, including those above, once you login.
@endcomponent