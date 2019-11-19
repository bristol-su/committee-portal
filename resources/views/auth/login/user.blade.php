@extends('layouts.app')

@section('app-content')
    <log-into-user
        :user="{{$user}}"
        :groups="{{$groups}}"
        :roles="{{$roles}}"
        :activity="{{$activity}}"
        redirect-to="{{$redirectTo}}">

    </log-into-user>
@endsection
