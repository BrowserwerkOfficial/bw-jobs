<?php

use Browserwerk\BwJobs\Controller\ApiController;
use Browserwerk\BwJobs\Controller\FrontendController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */
(static function () {
    ExtensionUtility::configurePlugin(
        'BwJobs',
        'Detail',
        [
            FrontendController::class => 'show, apply, perform',
        ],
        [
            FrontendController::class => 'perform',
        ],
    );

    ExtensionUtility::configurePlugin(
        'BwJobs',
        'List',
        [
            FrontendController::class => 'list',
        ],
        [
            FrontendController::class => 'list',
        ],
    );

    ExtensionUtility::configurePlugin(
        'BwJobs',
        'Api',
        [
            ApiController::class => 'listJobPositions',
        ],
        [
            ApiController::class => 'listJobPositions',
        ],
    );
})();
