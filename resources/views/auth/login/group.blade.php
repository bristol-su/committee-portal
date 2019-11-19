@extends('layouts.app')

@section('app-content')
    <log-into-group
        :groups="{{$groups}}"
        :roles="{{$roles}}"
        :activity="{{$activity}}"
        redirect-to="{{$redirectTo}}">

    </log-into-group>
@endsection
