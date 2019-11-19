@extends('layouts.settings')

@section('settings-title', 'Assign Permissions')

@section('settings-content')

    <site-permission
        :permission="{{$permission}}">

    </site-permission>

@endsection
