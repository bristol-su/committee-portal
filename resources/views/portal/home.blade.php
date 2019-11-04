@extends('layouts.app')

@section('app-content')
    <div class="container-fluid" style="text-align: center">

    <toggle-admin-or-participant
    :admin="{{($administrator?'true':'false')}}">

    </toggle-admin-or-participant>

    <activities
        :activities="{{json_encode($activities)}}"
        :admin="{{($administrator?'true':'false')}}">
    </activities>

    </div>

@endsection
