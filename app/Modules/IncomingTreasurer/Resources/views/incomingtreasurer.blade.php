@extends('incomingtreasurer::layouts.app')

@section('title', 'Incoming Treasurer')


@section('module-content')
    <div class="py-5">
        <div class="container" style="text-align: center">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Treasurer Training</h2>
                </div>
                <div class="col-md-12">
                    <p>Congratulations on becoming treasurer! Your first task to affiliate as treasurer is to complete
                        the compulsory online treasurer training [insert link] which will give you the skills and
                        knowledge you need to manage the group's finances, and explain BSU's processes for income and
                        expenditure.</p>
                    <p>There are a few quiz questions to test your knowledge from the training, and then some questions
                        and terms that we need you to agree to, and then you will completed the steps you need to be
                        activated as the new treasurer. This will take [a few days?] after you have completed your
                        tasks. Once you have been confirmed as the new treasurer you will be responsible for authorising
                        all expenses and invoice payments.</p>
                    <p>Please make sure that you are a member of the group on unioncloud so that Student Services can
                        update your role in the committee, and that you have signed up for the student expenses app, so
                        that members can ask you to authorise their expenses.</p>

                </div>
            </div>
            <div class="row" style="margin-top: 5%;">
                <div class="col-md-12">
                    <user-questions>

                    </user-questions>
                </div>
            </div>
        </div>
    </div>

@endsection





