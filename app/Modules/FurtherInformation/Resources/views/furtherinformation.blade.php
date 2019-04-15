@extends('furtherinformation::layouts.app')

@section('title', '#WeAreBristol Further Information.')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Further Information - <small>#WeAreBristol</small></h2>
                    <p class="">All the details you need to complete your submission and take part in #WeAreBristol.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-align: left;">
                    <ul>
                        <li><a href="{{serveStatic('wearebristol-club-information-pack-dates.pdf')}}" target="_blank">#WeAreBristol Club Information Pack - Dates</a></li>
                        <li><a href="{{serveStatic('wearebristol-club-criteria.pdf')}}" target="_blank">#WeAreBristol Club Criteria</a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>


@endsection


