@component('mail::message')

Hi {{$user->forename}}!

The outgoing treasurer has completed their review of last year's finances. You can review the reports for last year and
their answers on the <a href="{{config('app.url')}}">Committee Portal</a>. Please review the information they've submitted
to get an up to date picture of the group's financial position at handover.

In a few days you will gain access to the eXpense365 allowing you to review and approve members expenses as well
as view income and expenditure reports. Please take some time to read the
<a href="{{serveStatic('How_to_use_eXpense365.pdf')}}">How to Guide</a> before you download and begin using the app.

@endcomponent