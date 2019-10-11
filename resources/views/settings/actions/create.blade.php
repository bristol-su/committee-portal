@extends('layouts.settings')

@section('settings-title', 'Add an Action')

@section('settings-content')

    <action-create
        :module-instance="{{$moduleInstance}}">

    </action-create>

@endsection
