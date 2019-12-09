<?php

return [
    'name' => 'File Upload',
    'description' => 'Allows uploading of a file or multiple files with approval',
    'settings' => [
        'schema' => [
            'groups' => [
                [
                    'legend' => "Page Design",
                    'fields' => [
                        [
                            'type' => 'input',
                            'inputType' => 'text',
                            'label' => 'Module Title',
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
                    'legend' => 'New Documents',
                    'fields' => [
                        [
                            'type' => 'input',
                            'inputType' => 'text',
                            'label' => 'Default document title',
                            'hint' => 'This will be the default title of a new file',
                            'model' => 'document_title'
                        ],
                        [
                            'type' => 'checkbox',
                            'label' => 'Multiple files',
                            'hint' => 'Should multiple files be able to be uploaded at the same time?',
                            'model' => 'multiple_files'
                        ],
                        [
                            'type' => 'checklist',
                            'label' => 'Allowed file types',
                            'listBox' => true,
                            'hint' => 'Which file types can be uploaded?',
                            'model' => 'allowed_extensions',
                            'values' => [
                                ['value' => 'doc', 'name' => 'Microsoft Word Document'],
                                ['value' => 'docx', 'name' => 'Microsoft Word Open XML Document'],
                                ['value' => 'odt', 'name' => 'OpenDocument Text Document'],
                                ['value' => 'pages', 'name' => 'Pages Document'],
                                ['value' => 'rtf', 'name' => 'Rich Text Format File'],
                                ['value' => 'txt', 'name' => 'Plain Text File'],
                                ['value' => 'csv', 'name' => 'Comma Separated Values File'],
                                ['value' => 'key', 'name' => 'Keynote Presentation'],
                                ['value' => 'keychain', 'name' => 'Mac OS X Keychain File'],
                                ['value' => 'pps', 'name' => 'PowerPoint Slide Show'],
                                ['value' => 'ppt', 'name' => 'PowerPoint Presentation'],
                                ['value' => 'pptx', 'name' => 'PowerPoint Open XML Presentation'],
                                ['value' => 'mid', 'name' => 'MIDI File'],
                                ['value' => 'mp3', 'name' => 'MP3 Audio File'],
                                ['value' => 'mpa', 'name' => 'MPEG-2 Audio File'],
                                ['value' => 'wav', 'name' => 'WAVE Audio File'],
                                ['value' => 'wma', 'name' => 'Windows Media Audio File'],
                                ['value' => '3gp', 'name' => '3GPP Multimedia File'],
                                ['value' => 'avi', 'name' => 'Audio Video Interleave File'],
                                ['value' => 'mov', 'name' => 'Apple QuickTime Movie'],
                                ['value' => 'mp4', 'name' => 'MPEG-4 Video File'],
                                ['value' => 'mpg', 'name' => 'MPEG Video File'],
                                ['value' => 'gif', 'name' => 'Graphical Interchange Format File'],
                                ['value' => 'jpg', 'name' => 'JPEG Image'],
                                ['value' => 'png', 'name' => 'Portable Network Graphic'],
                                ['value' => 'pdf', 'name' => 'Portable Document Format File'],
                                ['value' => 'xlr', 'name' => 'Works Spreadsheet'],
                                ['value' => 'xls', 'name' => 'Excel Spreadsheet'],
                                ['value' => 'xlsx', 'name' => 'Microsoft Excel Open XML Spreadsheet'],
                                ['value' => 'zip', 'name' => 'Zipped File']
                            ]
                        ]
                    ]
                ],
                [
                    'legend' => "Status Changes",
                    'fields' => [
                        [
                            'type' => 'select',
                            'label' => 'Initial Status',
                            'hint' => 'What status should all new files have?',
                            'model' => 'initial_status',
                            'values' => [
                                'Awaiting Approval', 'Approved', 'Approved Pending Comments', 'Rejected'
                            ]
                        ],
                        [
                            'type' => 'checklist',
                            'label' => 'Available Statuses',
                            'hint' => 'A list of available statuses',
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
            'statuses' => ['Awaiting Approval', 'Approved', 'Rejected'],
            'document_title' => 'Document',
            'allowed_extensions' => []
        ],
        'options' => [
            'validateDebounceTime' => 0
        ]
    ],
];
