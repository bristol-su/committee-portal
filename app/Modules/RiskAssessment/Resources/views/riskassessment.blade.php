@extends('riskassessment::layouts.app')

@section('title', 'Risk Assessment')


@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Risk Assessment</h2>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="riskassessment-root">


                <upload-file
                        module="riskassessment"
                        default-title="Risk Assessment {{getReaffiliationYear()}}/{{substr(getReaffiliationYear()+1, 2, 2)}}"
                >
                </upload-file>


            </div>
        </div>
    </div>
@endsection





