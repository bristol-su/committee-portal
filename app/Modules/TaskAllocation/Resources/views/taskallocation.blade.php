@extends('taskallocation::layouts.app')

@section('title', 'Task Allocation')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <h2 class="">Reaffiliation Task Allocation</h2>
                    <p class="">The key to great leadership is delegation... This is your chance to allocate a number of
                        specific reaffiliation tasks to members of your committee (although you will have permissions to
                        complete them yourself if you wish). Please use the options below to tell us who on your committee
                        is doing what, and we'll reach out to them with some guidance on how they can complete the
                        task.</p>

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


