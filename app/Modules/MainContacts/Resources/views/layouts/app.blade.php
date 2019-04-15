@extends('layouts.app')


@section('content')

    <div id="maincontacts-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/maincontacts.js') }}"></script>

@endpush