<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Controller;

use Browserwerk\BwJobs\Domain\Model\JobPosition;
use Browserwerk\BwJobs\Domain\Repository\JobPositionRepository;
use Browserwerk\BwJobs\Domain\Repository\LocationRepository;
use Browserwerk\BwJobs\Domain\Repository\CategoryRepository;
use Browserwerk\BwJobs\Service\MetaDataService;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Http\ForwardResponse;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

/**
 * FrontendController
 */
class FrontendController extends ActionController
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
     * metaDataService
     *
     * @var MetaDataService
     */
    protected $metaDataService;

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
     * @param MetaDataService $metaDataService
     */
    public function injectMetaDataService(MetaDataService $metaDataService)
    {
        $this->metaDataService = $metaDataService;
    }

    /**
     * action index
     *
     * @return ResponseInterface
     */
    public function indexAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action list
     *
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $locations = $this->locationRepository->findAll();
        $categories = $this->categoryRepository->findAll();

        $this->view->assignMultiple(
            [
                'locations' => $locations,
                'categories' => $categories
            ],
        );

        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param JobPosition|null $jobPosition
     * @return ResponseInterface
     */
    public function showAction(?JobPosition $jobPosition = null): ?ResponseInterface
    {
        // Redirect to list view if job position is missing
        if (empty($jobPosition)) {
            return $this->redirectToList();
        }

        $this->metaDataService->injectMetaForJobPosition($jobPosition);
        $this->metaDataService->setTitleForJobPosition($jobPosition);

        $this->view->assignMultiple(
            [
                'jobPosition' => $jobPosition,
                'firstContactPerson' => $jobPosition->getFirstLocation()->getFirstContactPerson(),
            ],
        );

        return $this->htmlResponse();
    }

    /**
     * action apply
     *
     * @param JobPosition|null $jobPosition
     * @return ResponseInterface
     */
    public function applyAction(?JobPosition $jobPosition = null): ResponseInterface
    {
        // Redirect to list view if job position is missing
        if (empty($jobPosition)) {
            return $this->redirectToList();
        }

        $this->metaDataService->injectMetaForJobPosition($jobPosition);
        $this->metaDataService->setTitleForJobPosition($jobPosition);

        $this->view->assignMultiple(
            [
                'jobPosition' => $jobPosition,
                'firstContactPerson' => $jobPosition->getFirstLocation()->getFirstContactPerson(),
            ],
        );

        return $this->htmlResponse();
    }

    /**
     * action perform
     */
    public function performAction()
    {
        return new ForwardResponse('apply');
    }

    /**
     * redirectToList
     */
    protected function redirectToList()
    {
        return $this->redirect(
            'list',
            null,
            null,
            null,
            $this->settings['listPid'],
        );
    }
}
