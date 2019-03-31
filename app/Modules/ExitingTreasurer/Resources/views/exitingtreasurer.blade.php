@extends('exitingtreasurer::layouts.app')

@section('title', 'Exiting Treasurer')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Exiting Treasurer</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>There are two reports attached; the Finance Summary report and the Transaction List. The Finance
                        Summary report summarises the group’s income and expenditure in the year and has the opening and
                        closing balances for the group account. This only includes cleared/posted transactions.</p>
                    <p>The Transaction List is a list of all the group’s transactions in the year. This list not only
                        includes the transactions which have cleared against your account, but also transactions which
                        will be posted to the account soon (marked with an asterisk) and also expense claims which
                        haven’t been approved yet (as well as being marked with an asterisk, these also have a reference
                        number beginning PQU).</p>
                    <p>Please would you review the reports and answer the following:</p>

                </div>
            </div>

        @if(count($documents) > 0)
            <!-- Show this if there are reports -->
                <div class="row">
                    <div class="col-md-12">
                        Here are your reports
                    </div>
                </div>
        @else
            <!-- Show this if there are no reports -->
                <div class="row">
                    <div class="col-md-12">
                        No reports have yet been uploaded.
                    </div>
                </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <treasurer-sign-off>

                </treasurer-sign-off>
            </div>
        </div>

        </div>
    </div>


@endsection


