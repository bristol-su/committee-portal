@extends('strategicplan::layouts.app')

@section('title', 'Strategic Plan')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align: left;">
                    <h2 class="">Strategic Plan</h2>
                    <p>We would love to have your strategic plan on file, as knowing what you aim to achieve will help
                        us plan our student group services and training to meet your needs. We have produced two
                        different strategic plan templates, one for clubs and societies and another for volunteering
                        projects. We are also happy to accept plans in other formats if you have your own. </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="strategicplan-root">


                        <upload-file
                                module="strategicplan"
                                default-title="Strategic Plan {{getReaffiliationYear()}}/{{substr(getReaffiliationYear()+1, 2, 2)}}"
                        >
                        </upload-file>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





