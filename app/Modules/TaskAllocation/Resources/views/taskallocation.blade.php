@extends('taskallocation::layouts.app')

@section('title', 'Task Allocation')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <h2 class="">Task Allocation</h2>
                    <p class="">Who should do what tasks?</p>

                </div>
            </div>
            <div class="row" style="text-align: center">
                <div class="col-md-12">

                    <task-allocation>

                    </task-allocation>

                </div>
            </div>
        </div>
    </div>


@endsection


