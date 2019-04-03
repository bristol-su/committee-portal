@extends('groupinfo::layouts.app')

@section('title', 'Group Information')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <h2 class="">Group Information</h2>
                    <p class="">Your responses to these questions will help us to keep our records updated.</p>
                </div>
            </div>
            <div class="row" style="text-align: center">
                <div class="col-md-12">

                    <group-info>

                    </group-info>

                </div>
            </div>
        </div>
    </div>


@endsection


