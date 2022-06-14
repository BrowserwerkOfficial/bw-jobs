<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Service;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

/**
 * ConnectionManagerService
 */
class ConnectionManagerService
{
    /**
     * @var string
     */
    const JOB_POSITIONS_TABLE = 'tx_bwjobs_domain_model_jobposition';

    /**
     * @var string
     */
    const EMPLOYMENT_TYPES_TABLE = 'tx_bwjobs_domain_model_employmenttype';

    /**
     * @var string
     */
    const CONTACT_PERSONS_TABLE = 'tx_bwjobs_domain_model_contactperson';

    /**
     * @var string
     */
    const CATEGORIES_TABLE = 'tx_bwjobs_domain_model_category';

    /**
     * @var string
     */
    const LOCATIONS_TABLE = 'tx_bwjobs_domain_model_location';

    /**
     * @var string
     */
    const JOB_POSITION_EMPLOYMENT_TYPE_MM_TABLE = 'tx_bwjobs_jobposition_employmenttype_mm';

    /**
     * @var string
     */
    const JOB_POSITION_LOCATION_MM_TABLE = 'tx_bwjobs_jobposition_location_mm';

    /**
     * @var string
     */
    const JOB_POSITION_CATEGORY_MM_TABLE = 'tx_bwjobs_jobposition_category_mm';

    /**
     * @var string
     */
    const LOCATION_CONTACT_PERSON_MM_TABLE = 'tx_bwjobs_location_contactperson_mm';

    /**
     * connectionPool
     *
     * @var ConnectionPool
     */
    protected $connectionPool;

    /**
     * @param ConnectionPool $connectionPool
     */
    public function injectConnectionPool(ConnectionPool $connectionPool)
    {
        $this->connectionPool = $connectionPool;
    }

    /**
     * @return QueryBuilder
     */
    public function getJobPositionsQueryBuilder(): QueryBuilder
    {
        return $this->connectionPool
            ->getConnectionForTable(self::JOB_POSITIONS_TABLE)
            ->createQueryBuilder();
    }

    /**
     * @return QueryBuilder
     */
    public function getEmploymentTypesQueryBuilder(): QueryBuilder
    {
        return $this->connectionPool
            ->getConnectionForTable(self::EMPLOYMENT_TYPES_TABLE)
            ->createQueryBuilder();
    }

    /**
     * @return QueryBuilder
     */
    public function getContactPersonsQueryBuilder(): QueryBuilder
    {
        return $this->connectionPool
            ->getConnectionForTable(self::CONTACT_PERSONS_TABLE)
            ->createQueryBuilder();
    }

    /**
     * @return QueryBuilder
     */
    public function getCategoriesQueryBuilder(): QueryBuilder
    {
        return $this->connectionPool
            ->getConnectionForTable(self::CATEGORIES_TABLE)
            ->createQueryBuilder();
    }

    /**
     * @return QueryBuilder
     */
    public function getLocationsQueryBuilder(): QueryBuilder
    {
        return $this->connectionPool
            ->getConnectionForTable(self::LOCATIONS_TABLE)
            ->createQueryBuilder();
    }
}
