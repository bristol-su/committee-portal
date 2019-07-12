@extends('admin.settings.events.base')

@section('event-content')
    <div style="text-align: left;">
        <div class="row">
            <div class="col-md-12">Event Name: {{$event->name}}</div>
        </div>
        <div class="row">
            <div class="col-md-12">Description: {{$event->description}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">Applies to: {{$event->logic->name}} ({{$event->for}})</div>
        </div>
        <div class="row">
            @if($event->end_date === null || $event->start_date === null)
                <div class="col-md-12">Always Active</div>
            @else
                <div class="col-md-12">From: {{$event->start_date}}</div>
                <div class="col-md-12">To: {{$event->end_date}}</div>
            @endif
        </div>
        <br/><br/>
        <div class="row">
            <div class="col-md-12">
                <module-list
                :event="{{ json_encode($event) }}"
                :student-logic="{{\App\Support\Logic\Logic::where('for', 'student')->get()}}"
                :group-logic="{{\App\Support\Logic\Logic::where('for', 'group')->get()}}">

                </module-list>
            </div>
        </div>
    </div>
@endsection