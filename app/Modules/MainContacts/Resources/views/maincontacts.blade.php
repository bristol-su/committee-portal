@extends('maincontacts::layouts.app')

@section('title', 'Main Contacts')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <h2 class="">Main Contacts</h2>
                    <p class="">Who should we contact in various situations?</p>

                </div>
            </div>
            <div class="row" style="text-align: center">
                <div class="col-md-12">

                    <main-contacts>

                    </main-contacts>

                </div>
            </div>
        </div>
    </div>


@endsection


