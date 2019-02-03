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
        ]
    ],

    'reaffiliation_status' => [
        'incomplete' => 'btn btn-danger',
    ],

    'reaffiliation_year' => (int) env('REAFFILIATION_YEAR', 2017),

];