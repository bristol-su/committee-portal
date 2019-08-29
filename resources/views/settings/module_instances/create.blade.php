@extends('layouts.settings')

@section('settings-title', 'Create Module Instance')

@section('settings-content')

    <module-instance-create
        :activity-id="{{$activity->id}}"
        for-logic="{{$activity->activity_for}}">

    </module-instance-create>

@endsection
