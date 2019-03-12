@extends('wabbudget::layouts.app')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">#WeAreBristol Budget</h2>
                    <p class="">Uploaded budgets</p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="wabbudget-root">

                <admin-file-table
                        module="wabbudget"
                >
                </admin-file-table>

            </div>
        </div>
    </div>
@endsection


