<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Controller;

use Browserwerk\BwJobs\Domain\Repository\JobPositionRepository;
use Browserwerk\BwJobs\View\ApiView;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

/**
 * ApiController
 */
class ApiController extends ActionController
{
    /**
     * @var ApiView
     */
    protected $view;

    /**
     * @var string
     */
    protected $defaultViewObjectName = ApiView::class;

    /**
     * jobPositionRepository
     *
     * @var JobPositionRepository
     */
    protected $jobPositionRepository;

    /**
     * @param JobPositionRepository $jobPositionRepository
     */
    public function injectJobPositionRepository(JobPositionRepository $jobPositionRepository)
    {
        $this->jobPositionRepository = $jobPositionRepository;
    }

    /**
     * action index
     *
     * @return ResponseInterface
     */
    public function indexAction(): ResponseInterface
    {
        return $this->jsonResponse();
    }

    /**
     * action listJobPositions
     *
     * @return ResponseInterface
     */
    public function listJobPositionsAction(): ResponseInterface
    {
        $queryParams = $this->request->getQueryParams();
        $jobPositions = $this->jobPositionRepository->findWithFilter(
            [
                'locationUid' => $queryParams['locationUid'],
                'categoryUid' => $queryParams['categoryUid'],
            ]
        );

        $this->view->setVariablesToRender(['jobPositions']);
        $this->view->assignMultiple(
            [
                'jobPositions' => $jobPositions,
            ],
        );

        return $this->jsonResponse();
    }
}
