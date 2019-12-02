@extends('layouts.app')

@section('app-content')
        <div class="container-fluid" style="text-align: center">
            <div class="row" style="padding-top: 7px;">
                <div class="col-md-12" style="text-align: center;">
                    <h1>Progress through {{$activity->name}}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if($activity->activity_for === 'role')
                        <role-activity-progress
                            :activity="{{$activity}}"></role-activity-progress>
                    @else
                        Not supported yet
                    @endif
                </div>
            </div>
        </div>


@endsection
