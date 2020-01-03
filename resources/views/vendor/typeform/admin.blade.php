@extends('typeform::layouts.app')

@section('title', settings('title'))

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align: center;">

                    <h2 class="">{{settings('title')}}</h2>
                    <p class="">{!! settings('description') !!}</p>

                    @if(settings('collect_responses'))
                        <responses
                                :responses="{{$responses}}"
                                :can-refresh-responses="{{(\BristolSU\Support\Permissions\Facade\PermissionTester::evaluate('typeform.admin.refresh-form-responses')?'true':'false')}}"></responses>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection