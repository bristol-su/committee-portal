@extends('bristolsu::base')

@section('title', 'Verify Email')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, <a
                            href="#"
                            onclick="event.preventDefault(); document.getElementById('resend-form').submit();"> {{ __('click here to request another') }}</a>
                        or refer to our <a target="_blank" href="{{config('portal.knowledge_base.url')}}">knowledge
                            base</a>.
                        <form id="resend-form" action="{{ route('verification.resend') }}" method="POST"
                              style="display: none;">@csrf</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
