@extends('riskassessment::layouts.app')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Riskassessment</h2>
                    <p class="">Uploaded riskassessments</p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="riskassessment-root">

                <admin-file-table
                        module="riskassessment"
                >
                </admin-file-table>

            </div>
        </div>
    </div>
@endsection

