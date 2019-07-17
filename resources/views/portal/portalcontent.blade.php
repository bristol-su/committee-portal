@extends('portal.portal')

@section('header-name')
    {{$event->name}} @if($admin)- Admin @endif
@endsection

@section('portal-content')
    <portal
    :event="{{$event}}"
    :admin="{{($admin?'true':'false')}}">

    </portal>

@endsection
