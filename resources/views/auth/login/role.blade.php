@extends('layouts.app')

@section('app-content')
    <log-into-role
    :roles="{{$roles}}"
    :activity="{{$activity}}"
    redirect-to="{{$redirectTo}}">

    </log-into-role>
@endsection
