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

defined('TYPO3') || die();

(static function () {
    /*
     * Module Group
     */
    ExtensionUtility::registerModule(
        'Browserwerk.BwJobs',
        'jobs',
        '',
        'after:web',
        [],
        [
            'access' => 'user,group',
            'iconIdentifier' => 'bw_jobs-modulegroup-jobs',
            'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod.xlf',
        ],
    );

    /*
     * Job Positions Module
     */
    ExtensionUtility::registerModule(
        'Browserwerk.BwJobs',
        'jobs',
        'jobpositions',
        '',
        [
            JobPositionController::class => 'administration',
        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:bw_jobs/Resources/Public/Icons/user_mod_jobpositions.svg',
            'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_jobpositions.xlf',
        ]
    );
    ExtensionManagementUtility::allowTableOnStandardPages('tx_bwjobs_domain_model_jobposition');

    /*
     * Employment Types Module
     */
    ExtensionUtility::registerModule(
        'Browserwerk.BwJobs',
        'jobs',
        'employmenttypes',
        '',
        [
            EmploymentTypeController::class => 'administration',
        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:bw_jobs/Resources/Public/Icons/user_mod_employmenttypes.svg',
            'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_employmenttypes.xlf',
        ],
    );
    ExtensionManagementUtility::allowTableOnStandardPages('tx_bwjobs_domain_model_employmenttype');

    /*
     * Contact Persons Module
     */
    ExtensionUtility::registerModule(
        'Browserwerk.BwJobs',
        'jobs',
        'contactpersons',
        '',
        [
            ContactPersonController::class => 'administration',
        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:bw_jobs/Resources/Public/Icons/user_mod_contactpersons.svg',
            'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_contactpersons.xlf',
        ],
    );
    ExtensionManagementUtility::allowTableOnStandardPages('tx_bwjobs_domain_model_contactperson');

    /*
     * Locations Module
     */
    ExtensionUtility::registerModule(
        'Browserwerk.BwJobs',
        'jobs',
        'locations',
        '',
        [
            LocationController::class => 'administration',
        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:bw_jobs/Resources/Public/Icons/user_mod_locations.svg',
            'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_locations.xlf',
        ],
    );
    ExtensionManagementUtility::allowTableOnStandardPages('tx_bwjobs_domain_model_location');

    /*
     * Categories Module
     */
    ExtensionUtility::registerModule(
        'Browserwerk.BwJobs',
        'jobs',
        'categories',
        '',
        [
            CategoryController::class => 'administration',
        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:bw_jobs/Resources/Public/Icons/user_mod_categories.svg',
            'labels' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_categories.xlf',
        ],
    );
    ExtensionManagementUtility::allowTableOnStandardPages('tx_bwjobs_domain_model_category');
})();
