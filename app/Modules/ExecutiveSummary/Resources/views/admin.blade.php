@extends('executivesummary::layouts.app')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Executivesummary</h2>
                    <p class="">Uploaded executivesummarys</p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="executivesummary-root">

                <admin-file-table
                        module="executivesummary"
                >
                </admin-file-table>

            </div>
        </div>
    </div>
@endsection


