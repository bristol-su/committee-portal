@extends('layouts.app')

@section('app-content')
    <log-into-group
        :groups="{{$groups}}"
        :activity="{{$activity}}"
        redirect-to="{{$redirectTo}}">

    </log-into-group>
@endsection
