@extends('riskassessment::layouts.app')

@section('title', 'Risk Assessment')


@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Risk Assessment</h2>
                    <p>Risk assessing is a legal requirement, and is your most powerful tool in planning to keep people
                        safe. At this stage we would like you to submit a Risk Assessment covering your main activities
                        (i.e. the things you already know you wil be doing next year). Guidance on completing a risk
                        assessment can be found <a
                                href="https://nusdigital.s3-eu-west-1.amazonaws.com/document/documents/34248/4bda355cdf26e05a6d549ce87ce275d7/Bristol_SU_risk_assessment_guidance_FINAL.pdf">
                            here.
                        </a>
                        If you run into any difficulty with this, our <a href="mailto:bristolsu@bristol.ac.uk">student
                            services team</a> will be happy to help.</p>
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





