@extends('bristolsu::base')

@section('title', 'Password Reset')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="identity"
                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}
                                or {{ __('Student ID') }}</label>

                            <div class="col-md-6">
                                <input id="identity" type="text"
                                       class="form-control{{ $errors->has('identity') ? ' is-invalid' : '' }}"
                                       name="identity" value="{{ old('identity') }}" required>

                                @if ($errors->has('identity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('identity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
