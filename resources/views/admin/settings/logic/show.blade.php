@extends('admin.settings.logic.base')

@section('logic-content')
    <div style="text-align: left;">
        <div class="row">
            <div class="col-md-12">Logic Name: {{$logic->name}}</div>
        </div>
        <div class="row">
            <div class="col-md-12">Description: {{$logic->description}}
            </div>
        </div>
        {{$logic}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <module-list--}}
{{--                :logic="{{ json_encode($logic) }}"--}}
{{--                :student-logic="{{\App\Support\Logic\Logic::where('for', 'student')->get()}}"--}}
{{--                :group-logic="{{\App\Support\Logic\Logic::where('for', 'group')->get()}}">--}}

{{--                </module-list>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection