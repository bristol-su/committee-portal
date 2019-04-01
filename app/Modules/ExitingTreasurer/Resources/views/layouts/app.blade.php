@extends('layouts.app')


@section('content')

    <div id="exitingtreasurer-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/exitingtreasurer.js') }}"></script>

@endpush