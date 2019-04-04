@extends('layouts.app')

@section('title', 'Portal Home')
@section('content')

    <div class="py-5">
        <div class="container" id="committee-portal-portal">
            <h2 style="text-align: center">Committee Portal <small>- {{\Auth::user()->getCurrentRole()->group->name}}</small></h2>
            <h4 style="text-align: center">
                <small>To make reaffiliating your group as easy as possible, we've put all of the tasks that need
                    completing in one place. Some tasks will only unlock after doing others, so please begin working
                    through them at your earliest convenience.
                </small>
            </h4>
            <br/>

            <committee-portal
            :modules="{{$modules}}"
            :order="{{json_encode(config('portal.header_order'))}}"
            >

            </committee-portal>

            <br/><br/>

        </div>
    </div>
@endsection
