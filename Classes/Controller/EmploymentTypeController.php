<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Controller;

use Browserwerk\BwJobs\Domain\Model\EmploymentType;
use Browserwerk\BwJobs\Domain\Repository\EmploymentTypeRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Backend\Routing\UriBuilder as BackendUriBuilder;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
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
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
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
        // See https://stackoverflow.com/questions/69780363/typo3-v11-5-1578950324-runtimeexception-the-given-page-record-is-invalid-mis
        if (TYPO3_MODE == 'BE' && !empty($this->settings['storagePid'])) {
            $_POST['id'] = (int)$this->settings['storagePid'];
        }

        $moduleTemplate = $this->initializeModuleTemplate(
            $this->moduleTemplateFactory->create($this->request)
        );

        return $this->htmlResponse($moduleTemplate->renderContent());
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
     * initializeModuleTemplate
     *
     * @param ModuleTemplate $moduleTemplate
     * @return ModuleTemplate
     */
    public function initializeModuleTemplate(ModuleTemplate $moduleTemplate)
    {
        $moduleTemplate->setContent($this->view->render());
        $buttonBar = $moduleTemplate->getDocHeaderComponent()->getButtonBar();
        $addEmploymentTypeButton = $buttonBar->makeLinkButton()
            ->setIcon($this->iconFactory->getIcon('actions-add', Icon::SIZE_SMALL))
            ->setTitle(LocalizationUtility::translate('LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_employmenttypes.xlf:create_employmenttype_record_label'))
            ->setShowLabelText(true)
            ->setHref($this->backendUriBuilder->buildUriFromRoute('record_edit', [
                'edit' => ['tx_bwjobs_domain_model_employmenttype' => [(int)$this->settings['storagePid'] => 'new']],
                'returnUrl' => $this->request->getAttribute('normalizedParams')->getRequestUri(),
            ]));
        $buttonBar->addButton($addEmploymentTypeButton);

        return $moduleTemplate;
    }
}
