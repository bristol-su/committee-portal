@extends('executivesummary::layouts.app')

@section('title', 'Executive Summary')

@section('module-content')

    <!-- Title and description -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Executive Summary - <small>#WeAreBristol</small></h2>
                    <p class="">Please upload your completed executive summary by 5pm on 8th April 2019. See Further
                        Information section for detail on what points this should cover.</p>
                    <p>An executive summary template can be found <a href="{{serveStatic('wearebristol-executive-summary-template.docx')}}">here</a>.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="executivesummary-root">


                        <upload-file
                                module="executivesummary"
                                default-title="Executive Summary {{getReaffiliationYear()}}/{{substr(getReaffiliationYear()+1, 2, 2)}}"
                        >
                        </upload-file>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
