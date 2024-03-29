<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Controller;

use Browserwerk\BwJobs\Domain\Model\EmploymentType;
use Browserwerk\BwJobs\Domain\Repository\EmploymentTypeRepository;
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
 * (c) 2024 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

/**
 * EmploymentTypeController
 */
class EmploymentTypeController extends ActionController
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
     * employmentTypeRepository
     *
     * @var EmploymentTypeRepository
     */
    protected $employmentTypeRepository;

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
     * @param EmploymentTypeRepository $employmentTypeRepository
     */
    public function injectEmploymentTypeRepository(EmploymentTypeRepository $employmentTypeRepository)
    {
        $this->employmentTypeRepository = $employmentTypeRepository;
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
        $employmentTypes = $this->employmentTypeRepository->findAll();
        $this->view->assign('employmentTypes', $employmentTypes);

        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param EmploymentType $employmentType
     * @return ResponseInterface
     */
    public function showAction(EmploymentType $employmentType): ResponseInterface
    {
        $this->view->assign('employmentType', $employmentType);

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
        $addEmploymentTypeButton = $buttonBar->makeLinkButton()
            ->setIcon($this->iconFactory->getIcon('actions-add', Icon::SIZE_SMALL))
            ->setTitle(LocalizationUtility::translate('LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_employmenttypes.xlf:create_employmenttype_record_label'))
            ->setShowLabelText(true)
            ->setHref($this->backendUriBuilder->buildUriFromRoute('record_edit', [
                'edit' => ['tx_bwjobs_domain_model_employmenttype' => [$storagePid => 'new']],
                'returnUrl' => $this->request->getAttribute('normalizedParams')->getRequestUri(),
            ]));
        $buttonBar->addButton($addEmploymentTypeButton);

        return $moduleTemplate->renderResponse('Administration');
    }
}
