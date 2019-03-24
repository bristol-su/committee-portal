@extends('groupinfo::layouts.app')

@section('title', 'Group Information')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <h2 class="">Group Info</h2>
                    <p class="">Please check the information we have on your group.</p>
                </div>
            </div>
            <div class="row" style="text-align: center">
                <div class="col-md-12">

                    <group-info
                            :group="{{\Auth::user()->getCurrentRole()->group->toJson()}}">

                    </group-info>

                </div>
            </div>
        </div>
    </div>


@endsection


