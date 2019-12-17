@extends('typeform::layouts.app')

@section('title', settings('title'))

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    <h2 class="">{{settings('title')}}</h2>
                    <p class="">{!! settings('description') !!}</p>

                    @if(settings('embed_type', 'widget') === 'widget')
                        <typeform-embed-widget
                            form-url="{{settings('form_url')}}"
                            :hide-headers="{{(settings('hide_headers', true)?'true':'false')}}"
                            :hide-footer="{{(settings('hide_footer', true)?'true':'false')}}">
                            
                        </typeform-embed-widget>
                    @else
                        <typeform-embed-popup
                                form-url="{{settings('form_url')}}"
                                :hide-headers="{{(settings('hide_headers', true)?'true':'false')}}"
                                :hide-footer="{{(settings('hide_footer', true)?'true':'false')}}"
                                mode="{{settings('embed_type')}}">
                        </typeform-embed-popup>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection