@extends('layouts.app')

@section('title', 'Welcome')
@section('content')
    <div class="text-center py-5">
        <div class="container">
            <div class="row my-5 justify-content-center">
                <div class="col-md-9">
                    <h1>Bristol SU Committee Portal</h1>
                    <p class="lead text-muted">
                        Welcome to your committee portal! This is where you upload all the relevant information to
                        ensure a smooth transition of information from the existing and new committee.
                    </p>
{{--                    <a href="{{url('/login')}}" class="btn btn-primary m-2">Login</a>--}}
                    <a href="{{url('/register')}}" class="btn btn-lg btn-secondary m-1">Register</a>
                </div>
            </div>
        </div>
    </div>
@endsection