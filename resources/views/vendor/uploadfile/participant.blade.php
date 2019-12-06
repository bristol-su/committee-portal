@extends('uploadfile::layouts.app')

@section('title', settings('title'))

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    <h2 class="">{{settings('title')}}</h2>
                    <p class="">{!! settings('description') !!}</p>
                    
                    <upload-file-root
                        :can-upload="{{(BristolSU\Support\Permissions\Facade\PermissionTester::evaluate('uploadfile.file.store')?'true':'false')}}"
                        :can-download="{{(BristolSU\Support\Permissions\Facade\PermissionTester::evaluate('uploadfile.file.download')?'true':'false')}}"
                        :can-view="{{(BristolSU\Support\Permissions\Facade\PermissionTester::evaluate('uploadfile.file.index')?'true':'false')}}"></upload-file-root>
                </div>
            </div>
        </div>
    </div>
@endsection

