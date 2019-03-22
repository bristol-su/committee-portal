@extends('presidenthandover::layouts.app')

@section('title', 'President Handover')

@section('module-content')

    <!-- Title and description -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Thanks!</h2>
                    <p class="">Thank you for giving us your societies new president!</p>
                </div>
            </div>

            <div>
                You told us your new {{$position_name}} is {{$forename}} {{$surname}}
            </div>



            </div>


        </div>
    </div>

@endsection
