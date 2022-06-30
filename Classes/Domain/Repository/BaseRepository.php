<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

/**
 * The base repository
 */
class BaseRepository extends Repository
{
    /**
     * @var string
     */
    const EXTENSION_KEY = 'bw_jobs';

    /**
     * @var int
     */
    const DEFAULT_STORAGE_PID = 1;

    /**
     * configurationManager
     *
     * @var ConfigurationManager
     */
    protected $configurationManager;

    /**
     * @param ConfigurationManager $configurationManager
     */
    public function injectConfigurationManager(ConfigurationManager $configurationManager)
    {
        $this->configurationManager = $configurationManager;
    }

    /**
     * @return array
     */
    protected function getStoragePids(): array {
        $configuration = $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT,
            self::EXTENSION_KEY,
        );

        $storagePid = $configuration['module.']['tx_bwjobs.']['persistence.']['storagePid'];

        if (empty($storagePid)) {
            return [self::DEFAULT_STORAGE_PID];
        }

        return [(int)$storagePid];
    }

    /**
     * Initialize
     */
    public function initializeObject() {
        /** @var Typo3QuerySettings $querySettings */
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);

        $querySettings->setRespectStoragePage(true);
        $querySettings->setStoragePageIds($this->getStoragePids());
        $querySettings->setIgnoreEnableFields(false);
        $querySettings->setIncludeDeleted(false);
        $querySettings->setRespectSysLanguage(true);
        $querySettings->setLanguageOverlayMode(false);

        $this->setDefaultQuerySettings($querySettings);
    }
}
