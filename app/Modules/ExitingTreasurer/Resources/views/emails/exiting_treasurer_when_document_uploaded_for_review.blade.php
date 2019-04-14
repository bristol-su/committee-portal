@component('mail::message')

Hi {{$user->forename}}!

We have just uploaded a financial document for {{$group->name}} to the Committee Portal.

Please login to to review the document in 'Outgoing Treasurer Sign-Off' where you will be able to sign-off and handover to your successor.
You won't be able to start the sign-off until both your Financial Summary report and Transaction List have been uploaded by us.

@endcomponent