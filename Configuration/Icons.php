<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

return [
    'bw_jobs-plugin-detail' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:bw_jobs/Resources/Public/Icons/user_plugin_detail.svg',
    ],
    'bw_jobs-plugin-list' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:bw_jobs/Resources/Public/Icons/user_plugin_list.svg',
    ],
    'bw_jobs-modulegroup-jobs' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:bw_jobs/Resources/Public/Icons/user_mod_jobs.svg',
    ],
];
