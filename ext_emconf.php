<?php

declare(strict_types=1);

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'BW Jobs',
    'description' => 'A job board extension for TYPO3 CMS.',
    'category' => 'plugin',
    'author' => 'Leon Seipp',
    'author_email' => 'l.seipp@browserwerk.de',
    'state' => 'stable',
    'clearCacheOnLoad' => 1,
    'version' => '2.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
