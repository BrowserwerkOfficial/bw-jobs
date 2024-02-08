<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2024 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

return [
    'bwjobs-plugin-detail' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:bw_jobs/Resources/Public/Icons/plugin_detail.svg',
    ],
    'bwjobs-plugin-list' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:bw_jobs/Resources/Public/Icons/plugin_list.svg',
    ],
    'bwjobs' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:bw_jobs/Resources/Public/Icons/mod.svg',
    ],
    'bwjobs-locations' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:bw_jobs/Resources/Public/Icons/mod_locations.svg',
    ],
    'bwjobs-jobpositions' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:bw_jobs/Resources/Public/Icons/mod_jobpositions.svg',
    ],
    'bwjobs-employmenttypes' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:bw_jobs/Resources/Public/Icons/mod_employmenttypes.svg',
    ],
    'bwjobs-contactpersons' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:bw_jobs/Resources/Public/Icons/mod_contactpersons.svg',
    ],
    'bwjobs-categories' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:bw_jobs/Resources/Public/Icons/mod_categories.svg',
    ],
];
