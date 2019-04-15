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
                    <p>Congratulations! Before you become the official treasurer of your group we need you to complete our
                        <a href="{{config('incomingtreasurer.training.link')}}" target="_blank">compulsory treasurer training</a>, without this training you will not be able to manage your groups
                    finances and the old treasurer will not be released of their duties.</p>

                    <p>Our online treasurer training will give you the skills and knowledge needed to manage your groups
                    finances, whilst also explaining Bristol SU's processes for income and expenditure (including
                    invoices and expenses claims). Once you have finished the online training please answer the below
                    questions. This will then allow us to upload your groups end of year Financial Statement and
                    Transaction List for both you and the outgoing treasurer to sign off.</p>

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





