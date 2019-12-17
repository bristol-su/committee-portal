@extends('bristolsu::base')

@section('title', 'Portal')

@section('content')
    <div id="vue-root">
        @yield('app-content')
    </div>
@endsection
