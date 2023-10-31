<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Controller;

use Browserwerk\BwJobs\Domain\Model\Location;
use Browserwerk\BwJobs\Domain\Repository\LocationRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Backend\Routing\UriBuilder as BackendUriBuilder;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

/**
 * LocationController
 */
class LocationController extends ActionController
{
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
     * locationRepository
     *
     * @var LocationRepository
     */
    protected $locationRepository;

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
     * @param LocationRepository $locationRepository
     */
    public function injectLocationRepository(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
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
        return $this->renderModuleTemplate(
            $this->moduleTemplateFactory->create($this->request)
        );
    }

    /**
     * action list
     *
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $locations = $this->locationRepository->findAll();
        $this->view->assign('locations', $locations);

        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param Location $location
     * @return ResponseInterface
     */
    public function showAction(Location $location): ResponseInterface
    {
        $this->view->assign('location', $location);

        return $this->htmlResponse();
    }

    /**
     * renderModuleTemplate
     *
     * @param ModuleTemplate $moduleTemplate
     * @return ResponseInterface
     */
    public function renderModuleTemplate(ModuleTemplate $moduleTemplate): ResponseInterface
    {
        $moduleTemplate->assign('settings', $this->settings);

        $storagePid = $this->settings['storagePid'];
        $buttonBar = $moduleTemplate->getDocHeaderComponent()->getButtonBar();
        $addLocationButton = $buttonBar->makeLinkButton()
            ->setIcon($this->iconFactory->getIcon('actions-add', Icon::SIZE_SMALL))
            ->setTitle(LocalizationUtility::translate('LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_locations.xlf:create_location_record_label'))
            ->setShowLabelText(true)
            ->setHref($this->backendUriBuilder->buildUriFromRoute('record_edit', [
                'edit' => ['tx_bwjobs_domain_model_location' => [$storagePid => 'new']],
                'returnUrl' => $this->request->getAttribute('normalizedParams')->getRequestUri(),
            ]));
        $buttonBar->addButton($addLocationButton);

        return $moduleTemplate->renderResponse('Administration');
    }
}
