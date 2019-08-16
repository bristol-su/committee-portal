@extends('layouts.settings')

@section('settings-title', 'All Activities')

@section('settings-content')
    <activity-index
        :activities="{{$activities}}">

    </activity-index>
@endsection
