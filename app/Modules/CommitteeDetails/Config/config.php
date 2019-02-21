<?php

return [

    'name' => 'CommitteeDetails',

    // List of committee positions which MUST be filled
    'required_committee_positions' => [
        5,6,7
    ],

    // List of positions which can only have one student filling them
    'single_role_available' => [
        5,6
    ],

    // List of all available positions. The sort of these will be applied to the committeedetails page
    'all_positions' => [
         5,6,7,14
    ]
];