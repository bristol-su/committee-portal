@extends('budget::layouts.app')

@section('title', '#WeAreBristol Budget')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Budget</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="budget-root">


                        <upload-file
                                module="budget"
                                default-title="Budget {{getReaffiliationYear()}}/{{substr(getReaffiliationYear()+1, 2, 2)}}"
                        >
                        </upload-file>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


