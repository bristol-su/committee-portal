@extends('constitution::layouts.app')

@section('title', 'Constitution')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Constitution</h2>
                    <p>Your constitution sets out how your group operates, and what your members can expect from your
                        committee. We need to keep an updated constitution on file for every student group, please
                        submit yours below.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="constitution-root">


                <upload-file
                        module="constitution"
                        default-title="Constitution {{getReaffiliationYear()}}/{{substr(getReaffiliationYear()+1, 2, 2)}}"
                >
                </upload-file>


            </div>
        </div>
    </div>
@endsection
