@extends('layouts.settings')

@section('settings-title', $logic->name)

@section('settings-content')

    <logic-show
        :logic="{{$logic}}">

    </logic-show>

@endsection
