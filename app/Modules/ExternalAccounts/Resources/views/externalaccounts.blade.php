@extends('externalaccounts::layouts.app')

@section('title', 'External Accounts')

@section('module-content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">External Accounts</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-align: left;">
                    <p>You have indicated that you have an external bank account, or you group has had an external
                        account
                        in previous years.
                        By external bank account, we mean any bank account (including paypal account, UoB bank account
                        or
                        other pot of funds), other than main Bristol SU bank account. Please read the External Bank
                        Account
                        Policy before checking the information below.</p>
                    <p>If you have never had an external bank account then please email <a
                                href="mailto:bristolsu@bristol.ac.uk">bristolsu@bristol.ac.uk</a>
                        immediately.</p>
                    <p style="text-align: center;">
                        <a href="{{serveStatic('bristol-su-external-bank-account-policy.pdf')}}">
                            <button class="btn btn-outline-info">External Bank Account Policy</button>
                        </a>
                    </p>

                    <hr/><br/><br/>

                    <submission>

                    </submission>

                </div>
            </div>
        </div>

    </div>
@endsection
