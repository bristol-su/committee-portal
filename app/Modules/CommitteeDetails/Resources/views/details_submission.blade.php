@extends('layouts.app')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Committee Portal</h2>
                    <p class="">Put your committee in below etc etc.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12"><a id="new-committee-member" class="btn btn-outline-primary" href="#">Add Committee Member</a><a class="btn btn-secondary" href="#">Save and Submit</a></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Student ID</th>
                                <th scope="col">Position</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($committee as $committeeMember)
                                    @include('committeedetails::templates.committee_row', ['committee' => $committeeMember])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('committeedetails::templates.new_committee_form')
@endsection