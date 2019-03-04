@extends('layouts.app')

@section('content')

    @php $modules = getModuleConfiguration(); @endphp
    <style>
        .module_button {
            width: 90%;
            margin-left: 5%;
            margin-right: 5%
        }
    </style>

    <div class="py-5">
        <div class="container">
            @foreach($modules->pluck('admin_header')->unique() as $header)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><b>{{config('portal.headers.'.$header.'.header', $header)}}</b></h5>
                                <h6 class="card-subtitle my-2 text-muted">{{config('portal.headers.'.$header.'.subtitle', $header)}}</h6>
                                <div class="row">
                                    @foreach($modules->where('admin_header', $header) as $module)

                                        @if($module['visible'])

                                            <div class="col-xs-4" style="width: 33%; padding: 2px;">
                                                <a href="{{url($module['admin_url'])}}">
                                                    <button
                                                            type="button"
                                                            class="module_button {{config('portal.reaffiliation_status.admin')}}"
                                                            @if(! $module['active']) disabled @endif
                                                    >
                                                        {{$module['button_title']}}
                                                    </button>
                                                </a>
                                            </div>

                                        @endif

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
            @endforeach
        </div>
    </div>
@endsection
