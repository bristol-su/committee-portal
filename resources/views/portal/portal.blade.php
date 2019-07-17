@extends('layouts.app')

@section('title', 'Portal Home')
@section('content')
    <div id="portal">
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="text-align: center">@yield('header-name', 'Your Portal')</h2>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-3">
                        <portal-sidebar
                                :participant="{{$events['participant']}}"
                                :administrator="{{$events['administrator']}}"
                                :current-event="{{$event}}"
                                :admin="{{($admin?'true':'false')}}">

                        </portal-sidebar>

                    </div>
                    <div class="col-md-9">
                        @yield('portal-content')
                    </div>
                </div>
                <br/>
            </div>
        </div>
    </div>



@endsection

@push('scripts')
    <script src="{{ mix('js/portal.js') }}"></script>
@endpush
