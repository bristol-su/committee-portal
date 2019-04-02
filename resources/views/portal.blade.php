@extends('layouts.app')

@section('title', 'Portal Home')
@section('content')

    <div class="py-5">
        <div class="container">
            <h2 style="text-align: center">Committee Portal</h2>
            <h4 style="text-align: center">
                <small>Choose a task below to get started!</small>
            </h4>
            @foreach($modules->pluck('header')->unique() as $header)
                {{--// TODO Headers may be empty if user not authorised to view any of them--}}

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

                                            <div class="col-xs-12 col-sm-6 col-md-4" style="padding: 2px;">
                                                <a href="{{url($module['user_url'])}}">
                                                    <button
                                                            type="button"
                                                            class="module-button
                                                            @cannot($module['rawModule']->alias.'.module.isActive') module-button-inactive @endcannot
                                                            @cannot($module['rawModule']->alias.'.reaffiliation.isResponsible') module-button-responsible @endcannot
                                                                    ">
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
