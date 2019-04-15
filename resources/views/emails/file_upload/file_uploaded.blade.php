@component('mail::message')

Hi {{$file->user->forename}}!

Just to let you know, we've received your document, and will soon be reviewing it. We'll let you
know once we have!

File: {{$file->title}}

Head to the <a href="{{config('app.url')}}">Committee Portal</a> to check out the file
@if(count($file->notes) > 0)
    and check out any notes left.
@endif

@endcomponent

