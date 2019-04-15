@extends('layouts.app')

@section('title', 'Welcome')
@section('content')
    <div class="text-center py-5">
        <div class="container">
            <div class="row my-5 justify-content-center">
                <div class="col-md-9">
                    <h1>Bristol SU Committee Portal</h1>
                    <p class="lead text-muted">
                        Hello! The Bristol SU Committee Portal is here to support a smooth handover between your
                        outgoing committee members and the new committee. This is where you can check all the relevant
                        information about your group is correct and upload any new information, meaning nothing should
                        get lost in emails and your new committee can hit the ground running ready for Welcome Week.
                    </p>
                    {{--                    <a href="{{url('/login')}}" class="btn btn-primary m-2">Login</a>--}}
                    <a href="{{url('/register')}}" class="btn btn-lg btn-secondary m-1">Register</a>
                </div>
            </div>
        </div>
    </div>
@endsection