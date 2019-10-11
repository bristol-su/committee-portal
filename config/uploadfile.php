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
                ]

            ]
        ],
        'model' => [
            'title' => 'Default Title',
            'description' => '',

        ],
        'options' => [
            'validateDebounceTime' => 0
        ]
    ],
];
