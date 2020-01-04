@extends('layouts.app')

@section('app-content')
    <log-into-resource
        :user="{{$user}}"
        :can-be-user="{{($canBeUser?'true':'false')}}"
        :groups="{{$groups}}"
        :roles="{{$roles}}"
        :activity="{{$activity}}"
        redirect-to="{{$redirectTo}}"
        :admin="{{($admin?'true':'false')}}">

    </log-into-resource>
@endsection
