@extends('strategicplan::layouts.app')

@section('title', 'Strategic Plan')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Strategic Plan - <small>#WeAreBristol</small></h2>
                    <p class="">Please upload your completed strategic plan by 5pm on 8th April 2019. </p>

                    <p>A toolkit to help you make your strategic plan can be found <a href="{{serveStatic('bristol-su-strategic-planning-toolkit.docx')}}">here</a>.</p>
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





