<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Controller;

use Browserwerk\BwJobs\Domain\Model\JobPosition;
use Browserwerk\BwJobs\Domain\Repository\JobPositionRepository;
use Browserwerk\BwJobs\Domain\Repository\LocationRepository;
use Browserwerk\BwJobs\Domain\Repository\CategoryRepository;
use Browserwerk\BwJobs\PageTitle\JobsPageTitleProvider;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Backend\Routing\UriBuilder as BackendUriBuilder;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Core\MetaTag\MetaTagManagerRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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
 * JobPositionController
 */
class JobPositionController extends ActionController
{
    /**
     * metaTagManagerRegistry
     *
     * @var MetaTagManagerRegistry
     */
    protected $metaTagManagerRegistry;

    /**
     * backendUriBuilder
     *
     * @var BackendUriBuilder
     */
    protected $backendUriBuilder;

    /**
     * iconFactory
     *
     * @var IconFactory
     */
    protected $iconFactory;

    /**
     * moduleTemplateFactory
     *
     * @var ModuleTemplateFactory
     */
    protected $moduleTemplateFactory;

    /**
     * jobPositionRepository
     *
     * @var JobPositionRepository
     */
    protected $jobPositionRepository;

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
     * jobsPageTitleProvider
     *
     * @var JobsPageTitleProvider
     */
    protected $jobsPageTitleProvider;

    /**
     * @param MetaTagManagerRegistry $metaTagManagerRegistry
     */
    public function injectMetaTagManagerRegistry(MetaTagManagerRegistry $metaTagManagerRegistry)
    {
        $this->metaTagManagerRegistry = $metaTagManagerRegistry;
    }

    /**
     * @param BackendUriBuilder $backendUriBuilder
     */
    public function injectBackendUriBuilder(BackendUriBuilder $backendUriBuilder)
    {
        $this->backendUriBuilder = $backendUriBuilder;
    }

    /**
     * @param IconFactory $iconFactory
     */
    public function injectIconFactory(IconFactory $iconFactory)
    {
        $this->iconFactory = $iconFactory;
    }

    /**
     * @param ModuleTemplateFactory $moduleTemplateFactory
     */
    public function injectModuleTemplateFactory(ModuleTemplateFactory $moduleTemplateFactory)
    {
        $this->moduleTemplateFactory = $moduleTemplateFactory;
    }

    /**
     * @param JobPositionRepository $jobPositionRepository
     */
    public function injectJobPositionRepository(JobPositionRepository $jobPositionRepository)
    {
        $this->jobPositionRepository = $jobPositionRepository;
    }

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
     * @param JobsPageTitleProvider $jobsPageTitleProvider
     */
    public function injectJobsPageTitleProvider(JobsPageTitleProvider $jobsPageTitleProvider)
    {
        $this->jobsPageTitleProvider = $jobsPageTitleProvider;
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
     * action administration
     *
     * @return ResponseInterface
     */
    public function administrationAction(): ResponseInterface
    {
        $moduleTemplate = $this->initializeModuleTemplate(
            $this->moduleTemplateFactory->create($this->request)
        );

        return $this->htmlResponse($moduleTemplate->renderContent());
    }

    /**
     * action list
     *
     * @param array $filter
     * @param int $currentPage
     * @return ResponseInterface
     */
    public function listAction(array $filter = [], int $currentPage = 1): ResponseInterface
    {
        $locations = $this->locationRepository->findAll();
        $categories = $this->categoryRepository->findAll();

        $filtered = false;
        $jobPositions = $this->jobPositionRepository->findAll();
        if (!empty($filter)) {
            $filtered = true;
            $jobPositions = $this->jobPositionRepository->filter($filter);
        }

        $arrayPaginator = new ArrayPaginator(
            $jobPositions->toArray(),
            $currentPage,
            (int)($this->settings['itemsPerPage'] ?? 10),
        );
        $pagination = new SimplePagination($arrayPaginator);

        $this->view->assignMultiple(
            [
                'filter' => $filter,
                'locations' => $locations,
                'categories' => $categories,
                'jobPositions' => $jobPositions,
                'filtered' => $filtered,
                'paginator' => $arrayPaginator,
                'pagination' => $pagination,
                'pages' => range(1, $pagination->getLastPageNumber()),
                'shouldPaginate' => $pagination->getLastPageNumber() > 1,
            ],
        );

        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param JobPosition $jobPosition
     * @return ResponseInterface
     */
    public function showAction(JobPosition $jobPosition): ResponseInterface
    {
        $this->addMetaTagsForJobPosition($jobPosition);
        $this->setTitleForJobPosition($jobPosition);

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
     * @param JobPosition $jobPosition
     * @return ResponseInterface
     */
    public function applyAction(JobPosition $jobPosition): ResponseInterface
    {
        $this->setTitleForJobPosition($jobPosition);

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
     * initializeModuleTemplate
     *
     * @param ModuleTemplate $moduleTemplate
     * @return ModuleTemplate
     */
    public function initializeModuleTemplate(ModuleTemplate $moduleTemplate)
    {
        $moduleTemplate->setContent($this->view->render());
        $buttonBar = $moduleTemplate->getDocHeaderComponent()->getButtonBar();
        $addJobPositionButton = $buttonBar->makeLinkButton()
            ->setIcon($this->iconFactory->getIcon('actions-add', Icon::SIZE_SMALL))
            ->setTitle(LocalizationUtility::translate('LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_jobpositions.xlf:create_jobposition_record_label'))
            ->setShowLabelText(true)
            ->setHref($this->backendUriBuilder->buildUriFromRoute('record_edit', [
                'edit' => ['tx_bwjobs_domain_model_jobposition' => [(int)$this->settings['storagePid'] => 'new']],
                'returnUrl' => $this->request->getAttribute('normalizedParams')->getRequestUri(),
            ]));
        $addCategoryButton = $buttonBar->makeLinkButton()
            ->setIcon($this->iconFactory->getIcon('actions-add', Icon::SIZE_SMALL))
            ->setTitle(LocalizationUtility::translate('LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_jobpositions.xlf:create_category_record_label'))
            ->setShowLabelText(true)
            ->setHref($this->backendUriBuilder->buildUriFromRoute('record_edit', [
                'edit' => ['tx_bwjobs_domain_model_category' => [(int)$this->settings['storagePid'] => 'new']],
                'returnUrl' => $this->request->getAttribute('normalizedParams')->getRequestUri(),
            ]));
        $buttonBar->addButton($addJobPositionButton);
        $buttonBar->addButton($addCategoryButton);

        return $moduleTemplate;
    }

    /**
     * setTitleForJobPosition
     *
     * @param JobPosition $jobPosition
     */
    public function setTitleForJobPosition(JobPosition $jobPosition)
    {
        $title = $jobPosition->getTitle();
        $seoTitle = $jobPosition->getSeoTitle();

        $this->jobsPageTitleProvider->setTitle($seoTitle ? $seoTitle : $title);
    }

    /**
     * addMetaTagsForJobPosition
     *
     * @param JobPosition $jobPosition
     */
    public function addMetaTagsForJobPosition(JobPosition $jobPosition)
    {
        /**
         * SEO
         */
        $seoTitle = $jobPosition->getSeoTitle();
        if (!empty($seoTitle)) {
            $this->metaTagManagerRegistry
                ->getManagerForProperty('title')
                ->addProperty('title', $seoTitle);
        }

        $seoDescription = $jobPosition->getSeoDescription();
        if (!empty($seoDescription)) {
            $this->metaTagManagerRegistry
                ->getManagerForProperty('description')
                ->addProperty('description', $seoDescription);
        }

        /**
         * Open Graph
         */
        $ogTitle = $jobPosition->getOgTitle();
        if (!empty($ogTitle)) {
            $this->metaTagManagerRegistry
            ->getManagerForProperty('og:title')
            ->addProperty('og:title', $ogTitle);
        }

        $ogDescription = $jobPosition->getOgDescription();
        if (!empty($ogDescription)) {
            $this->metaTagManagerRegistry
            ->getManagerForProperty('og:description')
            ->addProperty('og:description', $ogDescription);
        }

        $ogImage = $jobPosition->getOgImage();
        if (!empty($ogImage)) {
            $this->metaTagManagerRegistry
                ->getManagerForProperty('og:image')
                ->addProperty(
                    'og:image',
                    GeneralUtility::locationHeaderUrl(
                        $ogImage->getOriginalResource()->getPublicUrl(),
                    ),
                    ['width' => 400, 'height' => 400],
                );
        }

        /**
         * Twitter
         */
        $twitterTitle = $jobPosition->getTwitterTitle();
        if (!empty($twitterTitle)) {
            $this->metaTagManagerRegistry
                ->getManagerForProperty('twitter:title')
                ->addProperty('twitter:title', $twitterTitle);
        }

        $twitterDescription = $jobPosition->getTwitterDescription();
        if (!empty($twitterDescription)) {
            $this->metaTagManagerRegistry
                ->getManagerForProperty('twitter:description')
                ->addProperty('twitter:description', $twitterDescription);
        }

        $twitterImage = $jobPosition->getTwitterImage();
        if (!empty($twitterImage)) {
            $this->metaTagManagerRegistry
                ->getManagerForProperty('twitter:image')
                ->addProperty(
                    'twitter:image',
                    GeneralUtility::locationHeaderUrl(
                        $twitterImage->getOriginalResource()->getPublicUrl(),
                    ),
                    ['width' => 400, 'height' => 400],
                );
        }

        $twitterCard = $jobPosition->getTwitterCard();
        if (!empty($twitterCard)) {
            $this->metaTagManagerRegistry
                ->getManagerForProperty('twitter:card')
                ->addProperty('twitter:card', $twitterCard);
        }
    }
}
