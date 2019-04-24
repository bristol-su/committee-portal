@extends('politicalactivity::layouts.app')

@section('module-content')
    <div class="py-5">
        <div class="container" style="text-align: center;">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Political Activity</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="politicalactivity-root">

                        <political-activity-submissions>
                        </political-activity-submissions>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


