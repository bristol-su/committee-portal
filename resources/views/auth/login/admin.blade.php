@extends('layouts.app')

@section('app-content')
    <log-into-admin
        :user="{{($act_as['user']??'null')}}"
        :groups="{{$act_as['groups']}}"
        :roles="{{$act_as['roles']}}"
        :activity="{{$activity}}"
        redirect-to="{{$redirectTo}}">

    </log-into-admin>
@endsection
