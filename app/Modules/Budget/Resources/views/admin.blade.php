@extends('budget::layouts.app')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Budget</h2>
                    <p class="">Uploaded budgets</p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="budget-root">

                <admin-file-table
                        module="budget"
                >
                </admin-file-table>

            </div>
        </div>
    </div>
@endsection


