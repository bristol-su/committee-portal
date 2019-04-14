@component('mail::message')

Hi {{$file->user->forename}}!

A file you uploaded to the Committee Portal has been reviewed by our staff and changed to 'Rejected'.

File: {{$file->title}}

Head to the <a href="{{config('app.url')}}">Committee Portal</a> to check out the file
@if(count($file->notes) > 0)
    and check out any notes left.
@endif

@endcomponent