@extends('layouts.app')


@section('content')

    <div id="exitingtreasurer-root">

        @yield('module-content')

@include('templates.back_to_portal_button')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/exitingtreasurer.js') }}"></script>

@endpush