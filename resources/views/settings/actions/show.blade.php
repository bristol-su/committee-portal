@extends('layouts.settings')

@section('settings-title', $action->name)

@section('settings-content')

    <action-show
        :action="{{$action}}">

    </action-show>

@endsection
