@extends('layouts.settings')

@section('settings-title', 'All Logic')

@section('settings-content')

    <logic-index
    :logics="{{$logics}}">

    </logic-index>

@endsection
