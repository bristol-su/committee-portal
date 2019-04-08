@extends('exitingtreasurer::layouts.app')

@section('title', 'Exiting Treasurer')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Outgoing Treasurer Sign-Off</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" style="text-align: left;">
                    <p></p>
                    <p>Your groups
                        <span class="bsu-tooltip">Finance Summary report
                            <span class="bsu-tooltiptext">
                                The Finance Summary report summarises the group’s income and expenditure in the year and has the opening and closing balances for the                                    group account. This only includes cleared/posted transactions.</span>
                        </span>
                        and
                        <span class="bsu-tooltip">
                            Transaction List
                            <span class="bsu-tooltiptext tooltip-bottom">
                                The Transaction List is a list of all the group’s transactions in the year. This list
                        not only includes the transactions which have cleared against your account, but also
                        transactions which will be posted to the account soon (marked with an asterisk) and expense
                        claims
                        which haven’t been approved yet (as well as being marked with an asterisk, these also have
                        a reference number beginning PQU).
                            </span>
                        </span>
                        are fundamental tools in controlling your groups finance. We need to ensure our reports match your records. Once you have read these reports, start the
                        sign-off below by clicking 'Sign-Off'.</p>
                    <br/>

                </div>
            </div>

            <div style="margin-top: 10px;" class="row">
                <div class="col-md-12">
                    <treasurer-sign-off>

                    </treasurer-sign-off>
                </div>
            </div>
        </div>
    </div>


@endsection