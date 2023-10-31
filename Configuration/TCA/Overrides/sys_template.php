<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

ExtensionManagementUtility::addStaticFile('bw_jobs', 'Configuration/TypoScript', 'BwJobs');
