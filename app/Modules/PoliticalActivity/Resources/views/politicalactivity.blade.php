@extends('politicalactivity::layouts.app')

@section('title', 'Political Activity')

@section('module-content')

    <!-- Title and description -->
    <div class="py-5">
        <div class="container">
            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <h2 class="">Political Activity</h2>
                    <p class="">All student groups affiliated to Bristol SU (a registered charity) and who have links to
                        political parties, need to be mindful of what restrictions charity law places on your
                        activities. Please read the following statement and tick to confirm you understand, agree and
                        will take responsibility to ensure relevant members of your committee are briefed on their
                        responsibilities.</p>
                </div>
            </div>
            <br/>

            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <p class=""></p>
                </div>
            </div>
            <div class="politicalactivity-root">


                <political-activity-submission>
                </political-activity-submission>


            </div>
        </div>
    </div>


@endsection
