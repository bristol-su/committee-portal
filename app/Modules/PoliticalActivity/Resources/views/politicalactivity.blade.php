@extends('politicalactivity::layouts.app')

@section('title', 'Political Activity')

@section('module-content')

    <!-- Title and description -->
    <div class="py-5">
        <div class="container">
            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <h2 class="">Political Activity</h2>
                    <p class="">Read the below and tick to confirm you've read it</p>
                </div>
            </div>
            <br/>

            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <p class="">Here's some information </p>
                </div>
            </div>
            <div class="politicalactivity-root">


                <political-activity-submission>
                </political-activity-submission>


            </div>
        </div>
    </div>


@endsection
