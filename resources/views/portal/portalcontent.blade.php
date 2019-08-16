@extends('portal.portal')

@section('header-name')
    {{$activity->name}} @if($admin)- Admin @endif
@endsection

@section('portal-content')
    <portal
    :event="{{$activity}}"
    :admin="{{($admin?'true':'false')}}">

    </portal>

@endsection
