@extends('layouts.app')

@section('app-content')
    <div id="portal">
        <div class="py-5" id="vue-root">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="text-align: center">{{$activity->name}}  @if($admin)- Admin @endif</h2>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-3">
                        <activity-sidebar
                            :activities="{{$activities}}"
                            :current-activity="{{$activity}}"
                        >

                        </activity-sidebar>

                    </div>
                    <div class="col-md-9">
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
                    </div>
                </div>
                <br/>
            </div>
        </div>
    </div>
    Red = mandatory, green = completed

@endsection
