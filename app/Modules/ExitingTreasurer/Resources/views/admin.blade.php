@extends('exitingtreasurer::layouts.app')

@section('title', 'Exiting Treasurer')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Exiting Treasurer</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    Here you may upload documents and see all submissions from exiting treasurers
                </div>
            </div>
            <hr/>
            @can('exitingtreasurer.view-upload-documents')
                <div class="row">
                    <div class="col-md-8" style="text-align: right">
                        <h3>Financial Documents to Upload</h3>
                    </div>
                    <div class="col-md-4">
                        <upload-request>

                        </upload-request>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <preview>
                            <upload-documents>

                            </upload-documents>
                        </preview>
                    </div>
                </div>
            @endcan
            <hr/>
            <div class="row">
                <div class="col-md-12"><h3>Sign Off Responses</h3></div>
                <div class="col-md-12">

                    <preview>
                        <all-submissions>

                        </all-submissions>
                    </preview>
                </div>
            </div>
        </div>
    </div>


@endsection


