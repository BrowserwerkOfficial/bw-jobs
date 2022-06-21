<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\View;

use TYPO3\CMS\Extbase\Mvc\View\JsonView;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

/**
 * ApiView
 */
class ApiView extends JsonView
{
    /**
     * @var array
     */
    protected $configuration = [
        'jobPositions' => [
            '_descendAll' => [
                '_only' => ['uid', 'title', 'locations', 'employmentTypes', 'slug'],
                '_descend' => [
                    'locations' => [
                        '_descendAll' => [
                            '_only' => ['uid', 'title'],
                        ],
                    ],
                    'employmentTypes' => [
                        '_descendAll' => [
                            '_only' => ['uid', 'title', 'type'],
                        ],
                    ],
                ],
            ],
        ],
    ];

    /**
     * @param mixed $value
     * @param array $configuration
     * @param bool $firstLevel
     * @return mixed
     */
    protected function transformValue($value, $configuration, $firstLevel = false)
    {
        if ($value instanceof ObjectStorage) {
            $value = $value->toArray();
        }
        return parent::transformValue($value, $configuration, $firstLevel);
    }
}
