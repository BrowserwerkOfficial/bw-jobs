<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Controller;

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
 * CategoryController
 */
class CategoryController extends ActionController
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
        $categories = $this->categoryRepository->findAll();
        $this->view->assign('categories', $categories);

        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param Category $category
     * @return ResponseInterface
     */
    public function showAction(CategoryController $category): ResponseInterface
    {
        $this->view->assign('category', $category);

        return $this->htmlResponse();
    }
};
