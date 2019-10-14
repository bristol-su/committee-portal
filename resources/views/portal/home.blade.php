@extends('layouts.app')

@section('app-content')

    <toggle-admin-or-participant
    :admin="{{($administrator?'true':'false')}}">

    </toggle-admin-or-participant>

    <activities
        :activities="{{json_encode($activities)}}"
        :admin="{{($administrator?'true':'false')}}">
    </activities>

@endsection
