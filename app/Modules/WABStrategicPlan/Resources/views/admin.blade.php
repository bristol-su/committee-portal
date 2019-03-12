@extends('wabstrategicplan::layouts.app')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">#WeAreBristol Strategic Plan</h2>
                    <p class="">Uploaded Strategic Plans</p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="wabstrategicplan-root">

                <admin-file-table
                        module="wabstrategicplan"
                >
                </admin-file-table>

            </div>
        </div>
    </div>
@endsection


