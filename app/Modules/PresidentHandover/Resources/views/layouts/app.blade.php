@extends('layouts.app')


@section('content')

    <div id="presidenthandover-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/presidenthandover.js') }}"></script>

@endpush