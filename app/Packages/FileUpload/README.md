# File Upload Implementation

To setup a module as a file upload:

- Create a file and note model, extending the relevant base model
- Create a migration extending the base migration
- Create a controller extending the base controller
- Enable the routes with ```    Route::FileUploads('SomethingController');```
- Below is an example blade template and vue template

```blade
@extends('budget::layouts.app')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Budget</h2>
                    <p class="">Something something something</p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="budget-root">


                <upload-file
                        module="budget"
                        default-title="Budget {{getReaffiliationYear()}}/{{substr(getReaffiliationYear()+1, 2, 2)}}"
                >
                </upload-file>


            </div>
        </div>
    </div>
@endsection











@extends('layouts.app')


@section('content')

    <div id="budget-root">

        @yield('module-content')

@include('templates.back_to_portal_button')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/budget.js') }}"></script>

@endpush
```

```vue
new Vue({
    el: '#executivesummary-root',


    components: {
        'upload-file': CustomFileUpload,
    },
});
```