<?php

return [
    '__name' => 'lib-google-translate',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/lib-google-translate.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'https://iqbalfn.com/'
    ],
    '__files' => [
        'modules/lib-google-translate' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-curl' => null
            ]
        ],
        'optional' => []
    ],
    '__inject' => [
        [
            'name' => 'libGoogleTranslate',
            'children' => [
                [
                    'name' => 'apiKey',
                    'question' => 'Your Googel Translate API Key',
                    'rule' => '!^.+$!'
                ]
            ]
        ]
    ],
    'autoload' => [
        'classes' => [
            'LibGoogleTranslate\\Library' => [
                'type' => 'file',
                'base' => 'modules/lib-google-translate/library'
            ]
        ],
        'files' => []
    ]
];
