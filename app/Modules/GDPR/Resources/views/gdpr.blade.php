@extends('gdpr::layouts.app')

@section('title', 'GDPR')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">GDPR</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" style="text-align: left;">
                    <p>As a student group leader you might need to handle personal data. Anyone who handles or processes
                    personal data needs to do so in line with the law. This includes making sure you know the basic
                    principles of the General Data Protection Act (GDPR). As a student leader, you are responsible for
                    ensuring that your group act in compliance with the law. Please read the following guidance on GDPR,
                    then check the box below to confirm.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <a href="{{serveStatic('data-protection-gdpr-guidance-for-student-leaders.docx')}}">
                        <button class="btn btn-outline-info btn-lg" style="margin-top: 10px">
                            GDPR for student leaders
                        </button>
                    </a>
                </div>
            </div>
<br/><br/>
            <div class="row">
                <div class="col-md-12">
                    <submission></submission>
                </div>
            </div>
        </div>
    </div>
@endsection
