@extends('layouts.app')


@section('content')

    <div id="libeldefamation-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/libeldefamation.js') }}"></script>

@endpush