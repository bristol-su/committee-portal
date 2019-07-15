@extends('admin.settings.base_settings')

@section('title', 'Logic')

@section('admin-content')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="text-align: center">Logic</h2>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-3">
                    @include('admin.settings.logic.sidebar')
                </div>
                <div class="col-md-9">
                    @yield('logic-content')
                </div>
            </div>
            <br/>
        </div>
    </div>
@endsection
