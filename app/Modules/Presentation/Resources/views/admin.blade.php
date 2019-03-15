@extends('presentation::layouts.app')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Presentation</h2>
                    <p class="">Uploaded presentations</p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="presentation-root">

                <admin-file-table
                        module="presentation"
                >
                </admin-file-table>

            </div>
        </div>
    </div>
@endsection

