

@extends('layouts.app')
@section('content')
    <div class="text-center py-5">
        <div class="container">
            <div class="row my-5 justify-content-center">
                <div class="col-md-9">
                    <h1>Bristol SU Committee Portal</h1>
                    <p class="lead text-muted">Lorem ipsum dolor sit amet, nemore dissentiet usu ad, ut vim diam denique, mei natum adhuc id. An mea dolores platonem periculis, doming ancillae vel te. Ad nec similique vulputate, justo alienum tractatos ad sea, at noluisse placerat qui. Summo labores sea id, usu iisque argumentum cu. </p>
                    <a href="{{url('/login')}}" class="btn btn-primary m-2">Login</a>
                    <a href="{{url('/register')}}" class="btn btn-secondary m-2">Register</a>
                </div>
            </div>
        </div>
    </div>
@endsection
