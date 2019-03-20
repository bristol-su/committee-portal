@extends('strategicplan::layouts.app')

@section('title', 'Strategic Plan')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Strategic Plan</h2>
                    <p></p>
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





