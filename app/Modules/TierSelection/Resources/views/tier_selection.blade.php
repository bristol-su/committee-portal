@extends('tierselection::layouts.app')

@section('title', '#WeAreBristol Tier Selection')
@section('module-content')

    <!-- Title and description -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Tier Selection - <small>#WeAreBristol</small></h2>
                    <p class="">Please select your #WeAreBristol Tier by 5pm on 8th April 2019. See the Further
                        Information section for much more on the benefits of each tier. </p>
                </div>
                <div class="col-md-12">
                    <tier-selection-user-page
                            :completed="{{ (\App\Modules\TierSelection\Entities\Submission::countSubmissions(getGroupID()) > 0 ? 'true' : 'false' )}}"
                            :submissions="{{ json_encode(\App\Modules\TierSelection\Entities\Submission::getSubmissions(getGroupID()) ) }}">
                    </tier-selection-user-page>
                </div>
            </div>
        </div>
    </div>

@endsection

