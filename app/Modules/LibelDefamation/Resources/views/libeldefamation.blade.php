@extends('libeldefamation::layouts.app')

@section('title', 'Libel & Defamation')

@section('module-content')

    <!-- Title and description -->
    <div class="py-5">
        <div class="container">
            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <h2 class="">Libel Awareness</h2>
                    <p class="">All student groups producing media content need to be aware of the risks of committing
                        libel or defamation. Please read the following statement and tick to confirm you understand,
                        agree and will take responsibility to ensure relevant members of your committee are briefed on
                        their responsibilities.</p>
                </div>
            </div>
            <br/>

            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <p class=""></p>
                </div>
            </div>
            <div class="libeldefamation-root">


                <libel-defamation-submission>
                </libel-defamation-submission>


            </div>
        </div>
    </div>

@endsection
