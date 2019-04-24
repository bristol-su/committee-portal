@extends('ngb::layouts.app')

@section('title', 'NGB')

@section('module-content')
    <!-- Title and description -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">NGB</h2>
                </div>
            </div>
            <div class="row" style="text-align: center;">
                <div class="col-md-12" style="text-align: left;">
                    <p class="">As part of our legal obligation for the safety of our members, we need to know that
                        students groups are following best practice for their activities. Your risk assessment sets out
                        what you are doing to keep your members safe, but please use the text box below to provide a
                        short statement covering:</p>
                    <ul>
                        <li>Who sets out the safety standards for your activities (i.e. a governing body)?</li>
                        <li>How do you ensure that you know what these standards are, and that your knowledge is up to
                            date?
                        </li>
                        <li>Do you take any specific action to ensure you meet these standards (beyond following your risk
                            assessment)?
                        </li>
                    </ul>


                </div>
            </div>
            <br/>

            <div class="ngb-root">


                <submission>
                </submission>


            </div>
        </div>
    </div>

@endsection


