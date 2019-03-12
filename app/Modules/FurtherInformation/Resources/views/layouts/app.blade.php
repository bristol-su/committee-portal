@extends('layouts.app')


@section('content')

    <div id="furtherinformation-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/furtherinformation.js') }}"></script>

@endpush