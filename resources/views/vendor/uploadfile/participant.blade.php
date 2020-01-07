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
                        :can-view="{{(BristolSU\Support\Permissions\Facade\PermissionTester::evaluate('uploadfile.file.index')?'true':'false')}}"
                        default-document-title="{{settings('document_title')}}"
                        :multiple-files="{{(settings('multiple_files')?'true':'false')}}"
                        :allowed-extensions="{{json_encode((settings('allowed_extensions')??[]))}}"
                        :can-update="{{(\BristolSU\Support\Permissions\Facade\PermissionTester::evaluate('uploadfile.file.update')?'true':'false')}}"
                        :can-delete="{{(\BristolSU\Support\Permissions\Facade\PermissionTester::evaluate('uploadfile.file.destroy')?'true':'false')}}"
                        :can-see-comments="{{(\BristolSU\Support\Permissions\Facade\PermissionTester::evaluate('uploadfile.comment.index')?'true':'false')}}"></upload-file-root>
                </div>
            </div>
        </div>
    </div>
@endsection

