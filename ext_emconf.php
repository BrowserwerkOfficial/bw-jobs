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
    'version' => '3.1.1',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.99.99',
        ],
    ],
];
