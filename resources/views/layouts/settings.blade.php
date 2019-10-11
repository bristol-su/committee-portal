@extends('bristolsu::base')

@section('title', 'Site Settings')

@section('content')
    <div id="vue-root">
        <b-row class="settings" id="root-site-settings">
            <b-col cols="2">
                <sidebar></sidebar>

            </b-col>
            <b-col>
                <div class="settings-content">
                    <div class="container">
                        <div class="row" style="padding-top: 7px;">
                            <div class="col-md-12" style="text-align: center;">
                                <h1>@yield('settings-title')</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @yield('settings-content')
                            </div>
                        </div>
                    </div>
                </div>
            </b-col>
        </b-row>
    </div>

@endsection

@push('scripts')
    <script src="{{mix('js/app.js')}}"></script>
@endpush
