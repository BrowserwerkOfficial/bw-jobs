<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

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
     * @var array $filter
     * @return QueryResultInterface|array
     */
    public function filter(array $filter)
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
