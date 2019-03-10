@extends('constitution::layouts.app')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Constitution</h2>
                    <p class="">Something something something</p>
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
