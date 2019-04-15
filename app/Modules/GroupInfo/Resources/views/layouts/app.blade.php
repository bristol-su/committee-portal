@extends('layouts.app')


@section('content')

    <div id="groupinfo-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/groupinfo.js') }}"></script>

@endpush