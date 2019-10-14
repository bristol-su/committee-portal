# Bristol SU Committee Portal

![Scrutinizer](https://scrutinizer-ci.com/g/bristol-su/committee-portal/badges/quality-score.png?b=master)

## The problem

As an organization, Bristol Student Union provides a huge number of different services to students of Bristol University. These range from help with appeals in regards to the examination process, to booking transport for a trip and managing society finances. Furthermore, since each team operates differently depending on what works best for them, each process can be different from both an end-user point of view and a staff member point of view when compared to any other process.

Faced with the issue of trying to align all processes so students could interact with the Student Union much easier and with less confusion, whilst allowing teams to continue to work in the way they think is best for them, the first (and second) version of the portal (name TBD) was born. This portal specifically handled the 'reaffiliation' process, of which every society (out of the 400 students at the University of Bristol have set up and continue to manage and run with help from the SU) must complete. This process involves submitting various documents, letting us know the committee for the upcoming year, and approving your yearly financial transactions for the last financial year ready for auditing.

Being done through email & Google forms, as had been done for years, was an administrative nightmare. Hundreds of emails a day, all with different information, had to be recorded and saved somewhere accessible to all staff members. The first portal handled this by having a set of steps which a student had to complete. These included uploading a constitution and a risk assessment, completing treasurer training etc, and through managing the process through the portal the administration and time taken to reaffiliate, from both a staff and student perspective, more than halved.

However, it quickly became apparent that this portal would need to handle many more processes. As the sole developer at the SU, I thought there must be a better way to provide most services the SU offers through an online portal, without me having to build and deploy every process either from scratch or from a prebuilt framework in which to build the processes.

## The solution

Well, this portal! (again, name TBD. Any ideas?) 

The general idea between the new portal, and what sets it aside from the previous work we or others have done in this field, is the realisation that most processes can be simplified to a core set of building blocks. By this, we mean things like:

- Uploading a file
- Filling in a form
- Completing a quiz
- Making a payment
- Selecting sets of users

If we could just build these core blocks once, anyone could string them together however they wanted, customise each tool to suit the purpose, and deploy to students instantly. And this is exactly what the portal does.

Each 'building block' is a Laravel microservice, usually with only a couple of pages and some logic, integrated into the [Bristol SU Support Package](https://github.com/bristol-su/support) which provides the functionality to take your Laravel app and put it beside multiple other apps to make a process. Through controlling access to different processes, we are providing a fully featured, customisable administrative portal, to suit any processes/ways of working a student union (or any other organisation) may have, all open sourced and free!

This is still a work in progress, although the portal is starting to take shape, and so any help would be appreciated in getting this project to a deployable standard. Similarly, if you think you or your organisation may be able to use the portal, we'd love to hear from you and keep in touch! If you have any ideas, feature requests or questions, pop me an email at [toby.twigger@bristol.ac.uk](mailto:toby.twigger@bristol.ac.uk)), or if you're interested in using the portal and want us to keep in touch, simply fill out [this form](https://www.bristolsu.org.uk/portalinterest) (all fields are optional, and we'll only contact you with major updates around the portal).
