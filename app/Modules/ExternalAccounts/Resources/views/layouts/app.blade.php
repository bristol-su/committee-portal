@extends('layouts.app')


@section('content')

    <div id="externalaccounts-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/externalaccounts.js') }}"></script>

@endpush