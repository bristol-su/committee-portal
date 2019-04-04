@extends('budget::layouts.app')

@section('title', 'Budget')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Annual Budget</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-align: left;">
                    <p>A budget is an estimate of your income and expenditure for a set period, prepared in advance. A
                        budget promotes forward thinking and allows you to determine whether you have sufficient
                        resources
                        to carry out your planned activities. During the year you should monitor your performance
                        against
                        your budget so that you can take corrective action if things do not go to plan.</p>
                    <p>If this section is optional for your group, we would still recommend that you prepare a budget,
                        but
                        you are not required to submit it to the SU.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="budget-root">


                        <upload-file
                                module="budget"
                                default-title="Budget {{getReaffiliationYear()}}/{{substr(getReaffiliationYear()+1, 2, 2)}}"
                        >
                        </upload-file>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


