@extends('incomingtreasurer::layouts.app')

@section('title', 'Incoming Treasurer')


@section('module-content')
    <div class="py-5">
        <div class="container" style="text-align: center">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Incoming Treasurer Training</h2>
                </div>
                <div class="col-md-12" style="text-align: left;">
                    <p>Congratulations on becoming treasurer! Your first task to affiliate as treasurer is to complete
                        the <a href="{{config('incomingtreasurer.training.link')}}" target="_blank">compulsory online
                            treasurer training</a> which will give you the skills and
                        knowledge you need to manage the group's finances, and explain BSU's processes for income and
                        expenditure.</p>
                    <p>Please go through the training materials, answer the questions below and then tick to confirm
                        you agree with the statements at the end of the page. We will then contact you once the outgoing
                        Treasurer has completed their Reaffiliation tasks. At this point you will be confirmed as the
                        new Treasurer and will be responsible for authorising all expenses and invoice payments.

                    </p>

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





