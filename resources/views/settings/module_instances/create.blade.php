@extends('layouts.settings')

@section('settings-title', 'Create Module Instance')

@section('settings-content')

    <module-instance-create
        :activity-id="{{$activity->id}}">

    </module-instance-create>

@endsection
