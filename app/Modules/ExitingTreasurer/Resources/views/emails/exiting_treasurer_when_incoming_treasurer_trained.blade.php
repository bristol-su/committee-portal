@component('mail::message')

Hi {{$user->forename}}!

{{$incomingTreasurer->forename}} has just completed their treasurer training. This means that we will upload your
groups financial documents within 3 working days for you to sign off on your accounts for {{getReaffiliationYear()-1}}/{{substr(getReaffiliationYear(), 2, 2)}}.

You will receive an email once we have uploaded the documents. At that point you will need to register on the
<a href="{{config('app.url')}}">Committee Portal</a> and complete the 'Outgoing Treasurer Sign-Off task.
This will then handover responsibiltiy for {{$group->name}}'s finances to {{$incomingTreasurer->forename}}

If your group also has an external bank account you will also need to complete the 'External Accounts' task before you can handover.

@endcomponent