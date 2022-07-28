<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Controller;

use Browserwerk\BwJobs\Domain\Model\ContactPerson;
use Browserwerk\BwJobs\Domain\Repository\ContactPersonRepository;
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
 * ContactPersonController
 */
class ContactPersonController extends ActionController
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
     * contactPersonRepository
     *
     * @var ContactPersonRepository
     */
    protected $contactPersonRepository;

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
     * @param ContactPersonRepository $contactPersonRepository
     */
    public function injectContactPersonRepository(ContactPersonRepository $contactPersonRepository)
    {
        $this->contactPersonRepository = $contactPersonRepository;
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
        $contactPersons = $this->contactPersonRepository->findAll();
        $this->view->assign('contactPersons', $contactPersons);

        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param ContactPerson $contactPerson
     * @return ResponseInterface
     */
    public function showAction(ContactPerson $contactPerson): ResponseInterface
    {
        $this->view->assign('contactPerson', $contactPerson);

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
        $addContactPersonButton = $buttonBar->makeLinkButton()
            ->setIcon($this->iconFactory->getIcon('actions-add', Icon::SIZE_SMALL))
            ->setTitle(LocalizationUtility::translate('LLL:EXT:bw_jobs/Resources/Private/Language/locallang_mod_contactpersons.xlf:create_contactperson_record_label'))
            ->setShowLabelText(true)
            ->setHref($this->backendUriBuilder->buildUriFromRoute('record_edit', [
                'edit' => ['tx_bwjobs_domain_model_contactperson' => [(int)$this->settings['storagePid'] => 'new']],
                'returnUrl' => $this->request->getAttribute('normalizedParams')->getRequestUri(),
            ]));
        $buttonBar->addButton($addContactPersonButton);

        return $moduleTemplate;
    }
}
