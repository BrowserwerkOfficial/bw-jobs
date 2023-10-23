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
use TYPO3\CMS\Core\Http\ApplicationType;
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
    protected BackendUriBuilder $backendUriBuilder;
    protected IconFactory $iconFactory;
    protected ModuleTemplateFactory $moduleTemplateFactory;

    public function __construct(
        BackendUriBuilder $backendUriBuilder,
        IconFactory $iconFactory,
        ModuleTemplateFactory $moduleTemplateFactory,
    ) {
        $this->backendUriBuilder = $backendUriBuilder;
        $this->iconFactory = $iconFactory;
        $this->moduleTemplateFactory = $moduleTemplateFactory;
    }

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
        if (!empty($this->settings['storagePid'])) {
            $_POST['id'] = (int)$this->settings['storagePid'];
        }

        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);;

        $moduleTemplate->setContent($this->view->render());

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
}
