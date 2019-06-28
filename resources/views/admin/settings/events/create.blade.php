@extends('admin.settings.events.base')

@section('event-content')
    <event-create
    :grouplogic="{{$groupLogic}}"
    :studentlogic="{{$studentLogic}}">

    </event-create>
@endsection