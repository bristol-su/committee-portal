@extends('maincontacts::layouts.app')

@section('title', 'Main Contacts')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <h2 class="">Notifications</h2>
                    <p class="">At key points in the year we'll aim to get in touch with your committee about
                        opportunities relavent to your group. It helps for us to have a primary contact we can go to, so
                        you can decide here who you would like to receive what information.</p>

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


