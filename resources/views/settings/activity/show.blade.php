@extends('layouts.settings')

@section('settings-title', $activity->name)

@section('settings-content')

    <activity-show
        :activity="{{$activity}}">

    </activity-show>

@endsection
