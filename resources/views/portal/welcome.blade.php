@extends('bristolsu::base')

@section('title', 'Welcome')
@section('content')
    <div class="text-center py-5">
        <div class="container">
            <div class="row my-5 justify-content-center">
                <div class="col-md-9">
                    <h1>Bristol SU Portal</h1>
                    <p class="lead text-muted">
			Hello! This is the Bristol SU Portal, a site under development which aims to bring the power and 
			accessibility of a customer portal to an open sourced platform, enabling any charity, non-profit or person without a development budget
			to host and customise a portal through which all services can be accessed.

			Registration to this demo site is enabled. Create your own services through the 'settings' page (by the dropdown in the top right), 
			or have a look at the service we've already made. For any questions, please contact me at toby.twigger@bristol.ac.uk, and thanks for your interest!
                    </p>
                    {{--                    <a href="{{url('/login')}}" class="btn btn-primary m-2">Login</a>--}}
                    <a href="{{url('/register')}}" class="btn btn-lg btn-secondary m-1">Register</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
