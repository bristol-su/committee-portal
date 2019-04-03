@extends('committeedetails::layouts.app')

@section('title', 'Committee Details')

@section('module-content')

    <!-- Title and description -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Committee</h2>
                    <p class="">We need to know who is on your committee so that we can make sure they receive
                        information relevant to their role. This is also an important step for you, and once you've
                        declared who is on your committee you unlock a module whereby you can begin to delgate a number
                        of the reaffiliation tasks that need to be completed. </p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">

            <committeedetails-user-page>

            </committeedetails-user-page>

        </div>
    </div>



@endsection
