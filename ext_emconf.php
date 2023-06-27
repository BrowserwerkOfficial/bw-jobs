<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'BW Jobs',
    'description' => 'A job board extension for TYPO3 CMS.',
    'category' => 'plugin',
    'author' => 'Browserwerk Team',
    'author_email' => 'info@browserwerk.de',
    'author_company' => 'Browserwerk GmbH',
    'state' => 'stable',
    'clearCacheOnLoad' => 1,
    'version' => '2.3.3',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.99.99',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
