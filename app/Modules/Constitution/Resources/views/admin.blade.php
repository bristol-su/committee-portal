@extends('constitution::layouts.app')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Constitution</h2>
                    <p class="">Uploaded constitutions</p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="constitution-root">

                <admin-file-table
                        module="constitution"
                >
                </admin-file-table>

            </div>
        </div>
    </div>
@endsection


