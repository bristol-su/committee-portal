@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

    @php $modules = getModuleConfiguration(); @endphp

    <div class="py-5">
        <div class="container">
            <h2 style="text-align: center">Administrator Dashboard</h2>
            @foreach($modules->pluck('admin_header')->unique() as $header)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><b>{{config('portal.headers.'.$header.'.header', $header)}}</b></h5>
                                <h6 class="card-subtitle my-2 text-muted">{{config('portal.headers.'.$header.'.subtitle', $header)}}</h6>
                                <div class="row">
                                    @foreach($modules->where('admin_header', $header) as $module)

                                        @can($module['rawModule']->alias.'.module.isVisible')

                                            <div class="col-xs-12 col-sm-6 col-md-4" style="padding: 2px;">
                                                <a href="{{url($module['admin_url'])}}">
                                                    <button
                                                            type="button"
                                                            class="module-button {{config('portal.reaffiliation_status.admin')}}"
                                                            @cannot($module['rawModule']->alias.'.module.isActive') disabled @endcannot
                                                    >
                                                        {{$module['button_title']}}
                                                    </button>
                                                </a>
                                            </div>

                                        @endcan
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
