@extends('uploadfile::layouts.app')

@section('title', settings('title'))

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    <h2 class="">{{settings('title')}}</h2>
                    <p class="">{!! settings('description') !!}</p>

                    <upload-file-admin
                        :can-download="{{(BristolSU\Support\Permissions\Facade\PermissionTester::evaluate('uploadfile.admin.file.download')?'true':'false')}}"
                        :can-change-status="{{(BristolSU\Support\Permissions\Facade\PermissionTester::evaluate('uploadfile.admin.status.create')?'true':'false')}}"
                        :statuses="{{json_encode(settings('statuses'))}}"></upload-file-admin>
                </div>
            </div>
        </div>
    </div>
@endsection