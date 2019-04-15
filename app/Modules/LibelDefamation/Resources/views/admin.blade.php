@extends('libeldefamation::layouts.app')

@section('title', 'Libel & Defamation')

@section('module-content')

    <div class="py-5">
        <div class="container" style="text-align: center;">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Libel & Defamation</h2>
                    <p>Blah blah</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="politicalactivity-root">

                        <libel-defamation-submissions>
                        </libel-defamation-submissions>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection


