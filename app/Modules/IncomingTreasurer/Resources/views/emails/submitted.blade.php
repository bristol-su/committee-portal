@component('mail::message')

Hi {{$submission->user->forename}}!

Thank you for completing your treasurer training course. We have contacted {{$oldTreasurer->forename}} and asked
them to sign off on the accounts for the {{getReaffiliationYear()-1}}/{{substr(getReaffiliationYear(), 2, 2)}} financial year.

We will contact you once they have done this, at which point you will be responsible for {{$submission->group()->name}}'s finances.

@endcomponent