<?php

return [

    'headers' => [
        'default' => [
            'header' => 'Default',
            'subtitle' => 'These modules aren\'t yet grouped together'
        ],
        'reaffiliation-mandatory' => [
            'header' => 'Reaffiliation - Mandatory',
            'subtitle' => 'Mandatory tasks to be completed in order to reaffiliate.'
        ],
        'reaffiliation-optional' => [
            'header' => 'Reaffiliation - Optional',
            'subtitle' => 'Optional tasks to help your group throughout the year.'
        ],
        'we-are-bristol' => [
            'header' => '#WeAreBristol',
            'subtitle' => 'We are Bristol Registration Modules'
        ],

        // Admin Headers
        'financial' => [
            'header' => 'Finance',
            'subtitle' => 'Financial Tasks.'
        ],
        'committee-details' => [
            'header' => 'Committee Details',
            'subtitle' => 'Information about the committee in a group.'
        ],
        'documents' => [
            'header' => 'Documents',
            'subtitle' => 'Documents submitted by committees.'
        ],
        'assets' => [
            'header' => 'Assets',
            'subtitle' => 'Information about assets of groups.'
        ],
        'group-info' => [
            'header' => 'Group Information',
            'subtitle' => 'Information about groups.'
        ],
        'ngb' => [
            'header' => 'NGB',
            'subtitle' => 'Still can\'t remember what this is....'
        ],

    ],

    'reaffiliation_status' => [
        'incomplete' => 'btn btn-outline-danger',

        'complete' => 'btn btn-outline-success',

        'admin' => 'btn btn-outline-info'
    ],

    'reaffiliation_year' => (int)env('REAFFILIATION_YEAR', 2017),

    'we_are_bristol' => [
        'enabled' => env('WE_ARE_BRISTOL_ENABLED', false)
    ],

    // TODO Is there another way?
    'exec_committee' => [
        5,22,23
    ]

];