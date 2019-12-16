<?php

return [
    'name' => 'File Upload',
    'description' => 'Allows uploading of a file or multiple files with approval',
    'file_types' => [
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
    ],
    'statuses' => [
        'Awaiting Approval', 'Approved', 'Approved Pending Comments', 'Rejected'
    ]
];
