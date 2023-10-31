<?php

declare(strict_types=1);

use Browserwerk\BwJobs\Controller\CategoryController;
use Browserwerk\BwJobs\Controller\ContactPersonController;
use Browserwerk\BwJobs\Controller\EmploymentTypeController;
use Browserwerk\BwJobs\Controller\JobPositionController;
use Browserwerk\BwJobs\Controller\LocationController;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

return [
    'bwjobs' => [
        'parent' => '',
        'position' => ['after' => 'web'],
        'access' => 'user,group',
        'iconIdentifier' => 'bwjobs',
        'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod.xlf',
        'extensionName' => 'BwJobs',
    ],
    'bwjobs_jobpositions' => [
        'parent' => 'bwjobs',
        'standalone' => true,
        'access' => 'user,group',
        'iconIdentifier' => 'bwjobs-jobpositions',
        'path' => 'module/bwjobs/jobpositions',
        'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_jobpositions.xlf',
        'extensionName' => 'BwJobs',
        'controllerActions' => [
            JobPositionController::class => [
                'administration',
            ],
        ],
    ],
    'bwjobs_employmenttypes' => [
        'parent' => 'bwjobs',
        'standalone' => true,
        'access' => 'user,group',
        'iconIdentifier' => 'bwjobs-employmenttypes',
        'path' => 'module/bwjobs/employmenttypes',
        'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_employmenttypes.xlf',
        'extensionName' => 'BwJobs',
        'controllerActions' => [
            EmploymentTypeController::class => [
                'administration',
            ],
        ],
    ],
    'bwjobs_contactpersons' => [
        'parent' => 'bwjobs',
        'standalone' => true,
        'access' => 'user,group',
        'iconIdentifier' => 'bwjobs-contactpersons',
        'path' => 'module/bwjobs/contactpersons',
        'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_contactpersons.xlf',
        'extensionName' => 'BwJobs',
        'controllerActions' => [
            ContactPersonController::class => [
                'administration',
            ],
        ],
    ],
    'bwjobs_locations' => [
        'parent' => 'bwjobs',
        'standalone' => true,
        'access' => 'user,group',
        'iconIdentifier' => 'bwjobs-locations',
        'path' => 'module/bwjobs/locations',
        'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_locations.xlf',
        'extensionName' => 'BwJobs',
        'controllerActions' => [
            LocationController::class => [
                'administration',
            ],
        ],
    ],
    'bwjobs_categories' => [
        'parent' => 'bwjobs',
        'standalone' => true,
        'access' => 'user,group',
        'iconIdentifier' => 'bwjobs-categories',
        'path' => 'module/bwjobs/categories',
        'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_categories.xlf',
        'extensionName' => 'BwJobs',
        'controllerActions' => [
            CategoryController::class => [
                'administration',
            ],
        ],
    ],
];
