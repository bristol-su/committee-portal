@extends('strategicplan::layouts.app')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Strategicplan</h2>
                    <p class="">Uploaded strategicplans</p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="strategicplan-root">

                <admin-note-template
                        module="strategicplan"
                >
                </admin-note-template>

            </div>
        </div>
    </div>
@endsection


