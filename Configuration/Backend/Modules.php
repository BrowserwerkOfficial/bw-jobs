<?php

use Browserwerk\BwJobs\Controller\ContactPersonController;
use Browserwerk\BwJobs\Controller\EmploymentTypeController;
use Browserwerk\BwJobs\Controller\JobPositionController;
use Browserwerk\BwJobs\Controller\LocationController;
use Browserwerk\BwJobs\Controller\CategoryController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

return [
    'jobs_BwJobs' => [
        'parent' => '',
        'position' => ['after' => 'web'],
        'access' => 'user,group',
        'iconIdentifier' => 'bw_jobs-modulegroup-jobs',
        'path' => '/module/web/BwJobs',
        'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod.xlf',
        'extensionName' => 'BwJobs',
    ],
    'jobs_BwJobsJobpositions' => [
        'parent' => 'jobs_BwJobs',
        'position' => ['before' => '*'],
        'access' => 'user,group',
        'iconIdentifier' => 'bw_jobs-modulegroup-jobpositions',
        'path' => 'module/BwJobsJobs/BwJobsJobpositions',
        'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_jobpositions.xlf',
        'extensionName' => 'BwJobs',
        'controllerActions' => [
            JobPositionController::class => [
                'administration',
            ],
        ],
    ],
    'jobs_BwJobsEmploymentTypes' => [
        'parent' => 'jobs_BwJobs',
        'position' => ['before' => '*'],
        'access' => 'user,group',
        'iconIdentifier' => 'bw_jobs-modulegroup-employmenttypes',
        'path' => 'module/BwJobsJobs/BwJobsEmploymentTypes',
        'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_employmenttypes.xlf',
        'extensionName' => 'BwJobs',
        'controllerActions' => [
            EmploymentTypeController::class => [
                'administration',
                ],
            ],
    ],
    'jobs_BwJobsContactPersons' => [
        'parent' => 'jobs_BwJobs',
        'position' => ['before' => '*'],
        'access' => 'user,group',
        'iconIdentifier' => 'bw_jobs-modulegroup-contactpersons',
        'path' => 'module/BwJobsJobs/BwJobsContactPersons',
        'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_contactpersons.xlf',
        'extensionName' => 'BwJobs',
        'controllerActions' => [
        ContactPersonController::class => [
                'administration',
            ],
        ],
    ],
    'jobs_BwJobsLocations' => [
        'parent' => 'jobs_BwJobs',
        'position' => ['before' => '*'],
        'access' => 'user,group',
        'iconIdentifier' => 'bw_jobs-modulegroup-locations',
        'path' => 'module/BwJobsJobs/BwJobsLocations',
        'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_locations.xlf',
        'extensionName' => 'BwJobs',
        'controllerActions' => [
        LocationController::class => [
                'administration',
            ],
        ],
    ],
    'jobs_BwJobsCategories' => [
        'parent' => 'jobs_BwJobs',
        'position' => ['before' => '*'],
        'access' => 'user,group',
        'iconIdentifier' => 'bw_jobs-modulegroup-categories',
        'path' => 'module/BwJobsJobs/BwJobsCategories',
        'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_categories.xlf',
        'extensionName' => 'BwJobs',
        'controllerActions' => [
        CategoryController::class => [
                'administration',
            ],
        ],
    ],
];


