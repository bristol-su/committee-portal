@extends('charitablegiving::layouts.app')


@section('content')

    <div id="charitablegiving-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/charitablegiving.js') }}"></script>

@endpush