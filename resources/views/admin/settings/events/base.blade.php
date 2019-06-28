@extends('admin.settings.base_settings')

@section('title', 'Events')

@section('admin-content')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="text-align: center">Events</h2>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-3">
                    @include('admin.settings.events.sidebar')
                </div>
                <div class="col-md-9">
                    @yield('event-content')
                </div>
            </div>
            <br/>
        </div>
    </div>
@endsection
