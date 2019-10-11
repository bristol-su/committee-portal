{{--TODO Is this the best way?--}}

@push('fonts')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
@endpush

@push('styles')
    @include('templates.javascript_injection')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
@endpush

@push('scripts')
{{--    <script src="{{ mix('js/global.js') }}"></script>--}}
@endpush

@push('meta-tags')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
