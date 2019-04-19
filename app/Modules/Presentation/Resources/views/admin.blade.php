@extends('presentation::layouts.app')

@section('title', 'Presentation')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Presentation - <small>#WeAreBristol</small></h2>
                    <p class="">Any presentations submitted by groups applying to #WeAreBristol will be shown
                        below. To change the status of a document, use the 'Status' dropdown. Doing this will trigger an
                        email to the student who uploaded it to let them know there was a change. Leave a note to let
                        groups know what they can change.</p>
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


