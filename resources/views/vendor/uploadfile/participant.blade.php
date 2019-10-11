@extends('uploadfile::layouts.app')

@section('title', 'Your Module')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    @inject('moduleInstance', 'BristolSU\Support\ModuleInstance\ModuleInstance')
                    <h2 class="">{{settings('title')}}</h2>
                    <p class="">{!! settings('description') !!}</p>
                    
                    
                    <upload-file-root></upload-file-root>
                </div>
            </div>
        </div>
    </div>
@endsection

