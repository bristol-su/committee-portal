<?php

use App\Modules\FileUpload\Events\DocumentApproved;
use App\Modules\FileUpload\Events\DocumentSubmitted;

return [
    'name' => 'File Upload',
    'description' => 'Allows uploading of a file or multiple files with approval',
    'completion' => [
        [
            'name' => 'Document Approved',
            'event' => DocumentApproved::class,
            'description' => 'Document is approved by a member of staff'
        ],
        [
            'name' => 'Document Submitted',
            'event' => DocumentSubmitted::class,
            'description' => 'Document is submitted by a student'
        ]
    ],
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
                    'legend' => "Behaviour",
                    'fields' => [
                        [
                            'type' => 'checkbox',
                            'label' => 'Notify submitter on rejection?',
                            'model' => 'notify_rejection',
                        ],
                        [
                            'type' => 'input',
                            'inputType' => 'number',
                            'label' =>  'Max number of files',
                            'model' => 'max_submission'
                        ]

                    ]
                ],

            ]
        ],
        'model' => [
            'title' => 'Default Title',
            'description' => '',
            'notify_rejection' => false,
            'max_submission' => 1
        ],
        'options' => [
            'validateDebounceTime' => 0
        ]
    ],
//    'permissions' => [
//        [
//            'permission' => 'upload',
//            'name' => 'Upload Document',
//            'description' => 'Allow a user to upload a document'
//        ],
//        [
//            'permission' => 'delete',
//            'name' => 'Delete Document',
//            'description' => 'Allow a user to delete a document'
//        ]
//    ]
];
