<?php

return [
    /*
     * During reaffiliation, we show Mandatory, Optional and Complete headers (along with non-reaffiliation ones
     *      as normal). After reaffiliation, switch to normal headers
     */
    'headers' => [
        'default' => [
            'header' => 'Additional Tasks',
            'subtitle' => 'Some other features to help you run your group',
            'hide-if-empty' => true,
        ],
        'reaffiliation-mandatory' => [
            'header' => 'Reaffiliation - Mandatory',
            'subtitle' => 'Mandatory reaffiliation tasks to be completed in order to reaffiliate.',
            'hide-if-empty' => true,
        ],
        'reaffiliation-optional' => [
            'header' => 'Reaffiliation - Optional',
            'subtitle' => 'Optional reaffiliation tasks to help your group throughout the year.',
            'hide-if-empty' => true,
        ],
        'we-are-bristol' => [
            'header' => '#WeAreBristol',
            'subtitle' => 'We are Bristol Registration',
            'hide-if-empty' => true,
        ],

        'reaffiliation-complete' => [
            'header' => 'Completed Reaffiliation Tasks',
            'subtitle' => 'These are all the tasks needed for reaffiliation which you\'ve finished!',
            'hide-if-empty' => false,
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

//    'reaffiliation_status' => [
//        'incomplete' => 'btn btn-outline-danger',
//
//        'complete' => 'btn btn-outline-success',
//
//        'admin' => 'btn btn-outline-info'
//    ],

    'reaffiliation_year' => (int)env('REAFFILIATION_YEAR', 2017),

    'we_are_bristol' => [
        'enabled' => env('WE_ARE_BRISTOL_ENABLED', false)
    ],

    // TODO Is there another way?
    'exec_committee' => [
        5, 22, 23
    ],

    'position_grouping' => [
        'presidents' => [5, 22, 23],
        'treasurers' => [6]
    ],


    'module_order' => [
        'PresidentHandover',
        'ExitingTreasurer',
        'GroupInfo',
        'CommitteeDetails',
        'MainContacts',
        'TaskAllocation',
        'Constitution',
        'RiskAssessment',
        'EquipmentList',
        'IncomingTreasurer',
        'ExternalAccounts',
        'Safeguarding',
        'NGB',
        'CharitableGiving',
        'LibelDefamation',
        'PoliticalActivity',
        'StrategicPlan',
        'Budget',
        'TierSelection',
        'FurtherInformation',
        'ExecutiveSummary',
        'WABBudget',
        'WABStrategicPlan',
        'Presentation'
    ],

    'knowledge_base' => [
        'url' => 'https://bristolsu.freshdesk.com/support/solutions/'
    ]

];