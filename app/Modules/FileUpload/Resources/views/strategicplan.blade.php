@extends('strategicplan::layouts.app')

@section('title', 'Strategic Plan')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align: left;">
                    <h2 class="">Strategic Plan</h2>
                    <p>Help us to support you better by uploading a copy of your strategic plan. By sharing your
                        aspirations with us you will be helping to plan our future services and enabling us to tailor
                        your development meetings so you get the most out of your time with us. We have a couple of
                        planning templates you can use below, however if you already have a plan written we can accept
                        it in other formats.</p>
                    <p>
                    <ul>
                        <li>
                            <a href="{{serveStatic('bristol-su-strategic-planning-toolkit.docx')}}">
                                General template
                            </a>
                        </li>
                        <li>
                            <a href="{{serveStatic('strategic-plan-template-volunteering-groups.docx')}}">
                                Template for volunteering groups
                            </a>
                        </li>
                    </ul>
                    </p>
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





