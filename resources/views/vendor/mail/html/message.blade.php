@component('mail::layout')
{{-- Header --}}
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {{ config('app.name') }}
    @endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Signature--}}
@component('mail::signature')

@endcomponent


{{-- Subcopy --}}
@isset($subcopy)
    @slot('subcopy')
        @component('mail::subcopy')
            {{ $subcopy }}
        @endcomponent
    @endslot
@endisset


{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        Charity #1139656  Company #6977417
    @endcomponent
@endslot
@endcomponent
