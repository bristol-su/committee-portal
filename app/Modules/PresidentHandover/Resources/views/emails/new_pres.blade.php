@component('mail::message')
Hi {{$newPresident->forename}}!

On behalf of the Bristol SU I'd like to congratulate you on your new post as {{$committeeRole->position_name}} of {{$group->name}}!
We're very exited to be working with you in the coming year.

You can now access the <a href="{{config('app.url')}}">Committee Portal</a>, your own personal hub for all information related to {{$group->name}}.
Upon first access you will be able to create a password and then be taken to the portal homepage.
This home screen will contain pages for you to upload various crucial documents and submit information we need from you to be reaffiliated.

These may include:
- Committee Details (you will need the student IDs or emails of each of your committee members for this stage e.g. xy12345)
- A Risk Assessment
- A Constitution
- Equipment (asset) list
- Budget
- Strategic Plan
- Finance documents (for completion by your elected treasurer)

As you complete each stage you'll notice the buttons jump to the 'Completed' section. You're aiming to get all mandatory buttons to this section!
The deadline for reaffiliating will be 1st July 2019, so make sure you’ve completed all the stages by this date
at the very latest! If you need any help at all, please don’t hesitate to contact the helpdesk by going to
<a href="https://bristolsu.freshdesk.com">bristolsu.freshdesk.com</a> and selecting ‘New Support Ticket’,
or by getting in touch with the SU on <a href="mailto:bristol-su@bristol.ac.uk">bristol-su@bristol.ac.uk</a>.

Please also make sure to sign up for the summer event of the year,
<a href="https://www.bristolsu.org.uk/events/committee-fest-2019">Committee Fest</a>, which will be taking place
on Monday 10th & Tuesday 11th June! We strongly encourage your committee to attend, in particular yourselves,
treasurers and secretaries, as this will provide vital training to help you run {{$group->name}} effectively.

But for now, happy reaffiliating!
@endcomponent