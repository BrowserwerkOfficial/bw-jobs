<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use Browserwerk\BwJobs\Service\ConnectionManagerService;
use Browserwerk\BwJobs\Domain\Repository\LocationRepository;
use Browserwerk\BwJobs\Domain\Repository\CategoryRepository;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

/**
 * The repository for JobPositions
 */
class JobPositionRepository extends Repository
{
    /**
     * locationRepository
     *
     * @var LocationRepository
     */
    protected $locationRepository;

    /**
     * categoryRepository
     *
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * connectionManagerService
     *
     * @var ConnectionManagerService
     */
    protected $connectionManagerService;

    /**
     * @param LocationRepository $locationRepository
     */
    public function injectLocationRepository(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function injectCategoryRepository(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param ConnectionManagerService $connectionManagerService
     */
    public function injectConnectionManagerService(ConnectionManagerService $connectionManagerService)
    {
        $this->connectionManagerService = $connectionManagerService;
    }

    /**
     * @return array
     */
    public function findAllForApi(): array
    {
        $queryBuilder = $this->connectionManagerService->getJobPositionsQueryBuilder();

        $queryBuilder
            ->select('*')
            ->from($this->connectionManagerService::JOB_POSITIONS_TABLE)
            ->leftJoin(
                $this->connectionManagerService::JOB_POSITIONS_TABLE,
                $this->connectionManagerService::JOB_POSITION_LOCATION_MM_TABLE,
                'mm',
                $queryBuilder->expr()->eq(
                    'mm.uid_foreign',
                    $queryBuilder->quoteIdentifier($this->connectionManagerService::JOB_POSITIONS_TABLE . '.uid'),
                ),
             );

        return $queryBuilder->executeQuery()->fetchAllAssociative();
    }

    /**
     * @var array $filter
     * @return QueryResultInterface
     */
    public function findWithFilter(array $filter): QueryResultInterface
    {
        $query = $this->createQuery();

        $filterConstraints = [];

        if (!empty($filter['locationUid'])) {
            array_push(
                $filterConstraints,
                $query->in('locations.uid', [$filter['locationUid']])
            );
        }

        if (!empty($filter['categoryUid'])) {
            array_push(
                $filterConstraints,
                $query->in('categories.uid', [$filter['categoryUid']])
            );
        }

        if (!empty($filterConstraints)) {
            $query->matching(
                $query->logicalAnd(
                     ...$filterConstraints
                )
            );
        }

        return $query->execute();
    }
}
