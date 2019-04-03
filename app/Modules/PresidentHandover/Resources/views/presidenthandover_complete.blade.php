@extends('presidenthandover::layouts.app')

@section('title', 'President Handover')

@section('module-content')

    <!-- Title and description -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12"><h2>Thank you!</h2></div>
                <div class="col-md-12" style="text-align: left;">
                    <p class="">
                        Thank you- you told us that your new {{strtolower($position_name)}} is {{$forename}} {{$surname}}.
                        Please note that until the new committee has completed reaffiliation you will still be able to
                        login to this portal.
                    </p>

                    <p>
                        We hope you've enjoyed the year as much as we have, and can't thank you enough for all the work
                        you've put into running {{$group_name}}.
                    </p>

                    <p>Very best of luck for the future from all of us at Bristol SU!</p>
                </div>
            </div>

        </div>


    </div>
    </div>

@endsection
