<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use Browserwerk\BwJobs\Service\ConnectionManagerService;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

/**
 * The repository for Locations
 */
class LocationRepository extends Repository
{
    /**
     * connectionManagerService
     *
     * @var ConnectionManagerService
     */
    protected $connectionManagerService;

    /**
     * @param ConnectionManagerService $connectionManagerService
     */
    public function injectConnectionManagerService(ConnectionManagerService $connectionManagerService)
    {
        $this->connectionManagerService = $connectionManagerService;
    }
}
