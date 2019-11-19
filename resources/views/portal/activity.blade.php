@extends('layouts.portal')

@section('header-name')
    {{$activity->name}} @if($admin)- Admin @endif
@endsection

@section('portal-content')
    <module-instances
    :activity="{{$activity}}"
    :admin="{{($admin?'true':'false')}}"
    :evaluation="{{$evaluation}}">

    </module-instances>

@endsection
