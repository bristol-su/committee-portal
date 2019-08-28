@extends('layouts.settings')

@section('settings-title', 'Create Module Instance')

@section('settings-content')

    <module-instance-create
        :activity-id="{{$activity->id}}"
        for-logic="{{$activity->forLogic->for}}"
        admin-logic="{{$activity->adminLogic->for}}">

    </module-instance-create>

@endsection
