@extends('layouts.app')


@section('content')

    <div id="gdpr-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/gdpr.js') }}"></script>

@endpush