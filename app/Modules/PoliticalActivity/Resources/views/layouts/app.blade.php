@extends('layouts.app')


@section('content')

    <div id="politicalactivity-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/politicalactivity.js') }}"></script>

@endpush