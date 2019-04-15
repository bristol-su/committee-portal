@extends('politicalactivity::layouts.app')

@section('title', 'Political Activity')

@section('module-content')

    <!-- Title and description -->
    <div class="py-5">
        <div class="container">
            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <h2 class="">Political Activity</h2>
                    <p class="">Bristol SU is a charity and as such Bristol SU and its affiliated student groups must comply with the law’s requirements for charities.</p>

                        <p>Please read the following statement regarding political groups before proceeding.</p>

                    <statement></statement>
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
