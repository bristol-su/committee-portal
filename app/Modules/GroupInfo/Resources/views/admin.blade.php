@extends('groupinfo::layouts.app')

@section('title', 'Group Information')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row"style="text-align: center">
                <div class="col-md-12">
                    <h2 class="">Group Info</h2>
                    <p class="">View information about groups.</p>
                </div>
            </div>
            <div class="row" style="text-align: center">
                <div class="col-md-12">

                    <p class="">General information about groups can be found in the 'Group Information'
                        spreadsheet.</p>
                    <p>
                        <a target="_blank"
                           href="https://docs.google.com/spreadsheets/d/1yDpL1iujjRAlu7Aif4wPoJaHrr7hdwDCdEcsZKZQuaA">
                            <button type="button" class="btn btn-lg btn-info">
                                Group Information Sheet
                            </button>
                        </a>
                    </p>

                    <p>
                        For more specific information, select the group in the dropdown at the top, and head to their
                        'Group Information' module. Here, you can view and change their information.
                    </p>

                </div>
            </div>
        </div>
    </div>


@endsection


