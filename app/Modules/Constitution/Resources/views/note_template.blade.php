@extends('constitution::layouts.app')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Constitution Templates</h2>
                    <p class=""></p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="constitution-root">

                <admin-note-template
                        module="constitution"
                >
                </admin-note-template>

            </div>
        </div>
    </div>
@endsection


