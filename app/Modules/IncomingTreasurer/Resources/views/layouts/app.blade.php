@extends('layouts.app')


@section('content')

    <div id="incomingtreasurer-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/incomingtreasurer.js') }}"></script>

@endpush