@extends('committeedetails::layouts.app')

@section('title', 'Committee Details')

@section('module-content')

    <!-- Title and description -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Committee</h2>
                    <p class="">Tell us who's on your committee and we will email them with all the relevant information
                        regarding their roles so you don't have to. By telling us whose on your committee you will
                        unlock the ability to assign these members reaffiliation tasks so you don't have to do all the
                        work yourself.
                    </p>

                    <p></p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">

            <committeedetails-user-page>

            </committeedetails-user-page>

        </div>
    </div>



@endsection
