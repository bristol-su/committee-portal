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

    @if($activity->type === 'multi-completable')
        <activity-instance-switcher
            :current-activity-instance="{{$activityInstance}}"
            :activity-instances="{{$activityInstances}}"></activity-instance-switcher>
    @endif

    Red = mandatory, green = completed
@endsection
