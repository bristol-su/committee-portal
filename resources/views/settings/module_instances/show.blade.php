@extends('layouts.settings')

@section('settings-title', $moduleInstance->name)

@section('settings-content')

    <module-instance-show
        :module-instance="{{$moduleInstance}}">

    </module-instance-show>

@endsection
