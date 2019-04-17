@extends('presidenthandover::layouts.app')

@section('title', 'President Handover')

@section('module-content')

    <!-- Title and description -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Your Successor</h2>
                    <p class="">Please let us know who is succeeding you in your role so that we can reach out to them
                        about reaffiliating your group</p>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <p>Search for your new president via Student ID (i.e. xy12345) or email.
                        The president must have an account on our <a href="https://bristolsu.org.uk">website</a>.</p>
                </div>

                <div class="col-md-12" style="margin-top: 2%;">
                    <new-president>
                    </new-president>
                </div>


            </div>


        </div>
    </div>




@endsection
