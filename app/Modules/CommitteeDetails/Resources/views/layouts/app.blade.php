@extends('layouts.app')


@section('content')

    <div id="committeedetails-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/committeedetails.js') }}"></script>

@endpush