@extends('layouts.app')

@section('app-content')
    <log-into-admin
        :user="{{$user}}"
        :groups="{{$groups}}"
        :roles="{{$roles}}"
        :activity="{{$activity}}"
        redirect-to="{{$redirectTo}}">

    </log-into-admin>
@endsection
