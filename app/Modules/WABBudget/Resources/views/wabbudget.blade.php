@extends('wabbudget::layouts.app')

@section('title', '#WeAreBristol Budget')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Budget -
                        <small>#WeAreBristol</small>
                    </h2>
                    <p class="">Please upload your completed budget by 5pm on 8th April 2019. </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>
                        We've made a <a
                                href="{{serveStatic('bristol-su-sports-group-budget-template.xls')}}">template</a> to help you create your budget.
<!--and a <a href="{{serveStatic('bristol-su-sports-group-budget-guide.pdf')}}">guide</a> on how to complete a budget.--> 
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="budget-root">


                        <upload-file
                                module="wabbudget"
                                default-title="#WeAreBristol Budget {{getReaffiliationYear()}}/{{substr(getReaffiliationYear()+1, 2, 2)}}"
                        >
                        </upload-file>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


