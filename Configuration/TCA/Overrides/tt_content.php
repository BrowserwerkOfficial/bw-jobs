<?php

declare(strict_types=1);

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

/*
 * Detail Plugin
 */
ExtensionUtility::registerPlugin(
    'BwJobs',
    'Detail',
    'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_plugin_detail.xlf:title'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['bwjobs_detail'] = 'select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['bwjobs_detail'] = 'pi_flexform';

ExtensionManagementUtility::addPiFlexFormValue(
    'bwjobs_detail',
    'FILE:EXT:bw_jobs/Configuration/FlexForms/flexform_detail.xml'
);

/*
 * List Plugin
 */
ExtensionUtility::registerPlugin(
    'BwJobs',
    'List',
    'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_plugin_list.xlf:title'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['bwjobs_list'] = 'select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['bwjobs_list'] = 'pi_flexform';

ExtensionManagementUtility::addPiFlexFormValue(
    'bwjobs_list',
    'FILE:EXT:bw_jobs/Configuration/FlexForms/flexform_list.xml'
);
