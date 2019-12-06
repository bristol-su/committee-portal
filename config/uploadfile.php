<?php

return [
    'name' => 'File Upload',
    'description' => 'Allows uploading of a file or multiple files with approval',
    'settings' => [
        'schema' => [
            'groups' => [
                [
                    'legend' => "Display",
                    'fields' => [
                        [
                            'type' => 'input',
                            'inputType' => 'text',
                            'label' =>  'Module Title',
                            'model' => 'title'
                        ],
                        [
                            'type' => 'textArea',
                            'label' => 'Description',
                            'hint' => 'This will appear at the top of the page',
                            'rows' => 4,
                            'model' => 'description'
                        ]
                    ]
                ],
                [
                    'legend' => "Status Changes",
                    'fields' => [
                        [
                            'type' => 'select',
                            'label' =>  'Initial Status',
                            'hint' => 'What status should all new files have?',
                            'model' => 'initial_status',
                            'values' => [
                                'Awaiting Approval', 'Approved', 'Approved Pending Comments', 'Rejected'
                            ]
                        ],
                        [
                            'type' => 'checklist',
                            'label' =>  'Available Statuses',
                            'hint' => 'A comma separated list of available statuses',
                            'listBox' => true,
                            'model' => 'statuses',
                            'values' => [
                                'Awaiting Approval', 'Approved', 'Approved Pending Comments', 'Rejected'
                            ]
                        ],
                    ]
                ]

            ]
        ],
        'model' => [
            'title' => 'Default Title',
            'description' => '',
            'initial_status' => 'Awaiting Approval',
            'statuses' => ['Awaiting Approval', 'Approved', 'Rejected']

        ],
        'options' => [
            'validateDebounceTime' => 0
        ]
    ],
];
