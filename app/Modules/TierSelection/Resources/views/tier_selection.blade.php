@extends('tierselection::layouts.app')

@section('module-content')

<!-- Title and description -->
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="">Tier Selection</h2>
                <p class="">Select your tier</p>
            </div>
        </div>
    </div>
</div>


<div class="py-5">
    <div class="container">

        <tier-selection-user-page
        :completed="{{ (\App\Modules\TierSelection\Entities\Submission::countSubmissions(getGroupID()) > 0 ? 'true' : 'false' )}}"
        :submissions="{{ json_encode(\App\Modules\TierSelection\Entities\Submission::getSubmissions(getGroupID()) ) }}">
        </tier-selection-user-page>

    </div>
</div>


@endsection

