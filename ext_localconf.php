<?php

use Browserwerk\BwJobs\Controller\JobPositionController;
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
    ExtensionUtility::configurePlugin(
        'BwJobs',
        'Detail',
        [
            JobPositionController::class => 'show, apply, perform',
        ],
        [
            JobPositionController::class => 'perform',
        ],
    );

    ExtensionUtility::configurePlugin(
        'BwJobs',
        'List',
        [
            JobPositionController::class => 'list',
        ],
    );

    ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    detail {
                        iconIdentifier = bw_jobs-plugin-detail
                        title = LLL:EXT:bw_jobs/Resources/Private/Language/locallang_plugin_detail.xlf:title
                        description = LLL:EXT:bw_jobs/Resources/Private/Language/locallang_plugin_detail.xlf:description
                        tt_content_defValues {
                            CType = list
                            list_type = bwjobs_detail
                        }
                    }
                    list {
                        iconIdentifier = bw_jobs-plugin-list
                        title = LLL:EXT:bw_jobs/Resources/Private/Language/locallang_plugin_list.xlf:title
                        description = LLL:EXT:bw_jobs/Resources/Private/Language/locallang_plugin_list.xlf:description
                        tt_content_defValues {
                            CType = list
                            list_type = bwjobs_list
                        }
                    }
                }
                show = *
            }
       }'
    );
})();
