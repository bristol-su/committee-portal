@push('fonts')
@endpush

@push('styles')
@endpush

@push('scripts')
@endpush

@push('meta-tags')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
