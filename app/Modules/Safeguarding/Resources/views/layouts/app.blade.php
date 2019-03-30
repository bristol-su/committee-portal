@extends('layouts.app')


@section('content')

    <div id="safeguarding-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/safeguarding.js') }}"></script>

@endpush