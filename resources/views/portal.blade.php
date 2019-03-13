@extends('layouts.app')

@section('title', 'Portal Home')
@section('content')

    <style>
        .module_button {
            width: 90%;
            margin-left: 5%;
            margin-right: 5%
        }
    </style>

    <div class="py-5">
        <div class="container">

            @foreach($modules->pluck('header')->unique() as $header)

                <div class="row">
                    <div class="col-md-12">

                        <div class="card">


                            <div class="card-body">

                                <h5 class="card-title"><b>{{config('portal.headers.'.$header.'.header', $header)}}</b>
                                </h5>

                                <h6 class="card-subtitle my-2 text-muted">{{config('portal.headers.'.$header.'.subtitle', $header)}}</h6>

                                <div class="row">
                                    @foreach($modules->where('header', $header) as $module)
                                        @can($module['rawModule']->alias.'.module.isVisible')

                                            <div class="col-xs-4" style="width: 33%; padding: 2px;">
                                                <a href="{{url($module['user_url'])}}">
                                                    <button
                                                            type="button"
                                                            class="module_button {{config('portal.reaffiliation_status.'.$module['reaffiliation_status'])}}"
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

                <br/><br/>

            @endforeach

        </div>
    </div>
@endsection
