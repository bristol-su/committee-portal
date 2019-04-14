@component('mail::message')

Hi {{$unionCloudStudent->forename}}!

Congratulations on your new role as treasurer of {{$group->name}}! We're very excited to start working with you.

In order to begin duties and assume your role as treasurer, you will first need to complete compulsory treasurer training on the committee portal!
All you'll need to do is follow <a href="{{url('/incomingtreasurer')}}">this link</a>, and create an account on the committee portal.

From here, you'll be directed to the finances page in order to do you training. This will need to be completed in
order for {{$group->name}} to reaffiliate, so make sure to do it in plenty of time before the deadline, and look
out for any other responsibilities that may be assign you!

If you need any help at all, please don’t hesitate to contact the helpdesk by going to <a href="bristolsu.freshdesk.com">bristolsu.freshdesk.com</a> and
selecting ‘New Support Ticket’, or by getting in touch with the SU on <a href="mailto:bristol-su@bristol.ac.uk">bristol-su@bristol.ac.uk</a>

@endcomponent