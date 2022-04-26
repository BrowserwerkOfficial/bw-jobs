<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Domain\Finishers;

use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Fluid\View\TemplatePaths;
use TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher;
use TYPO3\CMS\Form\Domain\Finishers\Exception\FinisherException;
use TYPO3\CMS\Form\Domain\Model\FormElements\FileUpload;
use TYPO3\CMS\Form\Domain\Runtime\FormRuntime;
use TYPO3\CMS\Form\Service\TranslationService;
use TYPO3\CMS\Form\ViewHelpers\RenderRenderableViewHelper;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

/**
 * EmailToApplicantFinisher
 */
class EmailToApplicantFinisher extends AbstractFinisher
{
    /**
     * @var string
     */
    protected $finisherIdentifier = 'EmailToApplicant';

    /**
     * @var string
     */
    protected $shortFinisherIdentifier = 'EmailToApplicant';

    /**
     * Executes this finisher
     * @throws FinisherException
     * @see AbstractFinisher::execute()
     *
     */
    protected function executeInternal()
    {
        $languageBackup = null;

        // Flexform overrides write strings instead of integers so
        // we need to cast the string '0' to false.
        if (
            isset($this->options['addHtmlPart'])
            && $this->options['addHtmlPart'] === '0'
        ) {
            $this->options['addHtmlPart'] = false;
        }

        $subject = $this->parseOption('subject');

        $recipientAddress = $this->parseOption('recipientAddress');
        $recipientAddress = is_string($recipientAddress) ? $recipientAddress : '';
        $recipientName = $this->parseOption('recipientName');
        $recipientName = is_string($recipientName) ? $recipientName : '';

        $senderAddress = $this->parseOption('senderAddress');
        $senderAddress = is_string($senderAddress) ? $senderAddress : '';
        $senderName = $this->parseOption('senderName');
        $senderName = is_string($senderName) ? $senderName : '';

        $addHtmlPart = $this->parseOption('addHtmlPart') ? true : false;
        $attachUploads = $this->parseOption('attachUploads');
        $title = $this->parseOption('title');
        $title = is_string($title) && $title !== '' ? $title : $subject;

        if (empty($subject)) {
            throw new FinisherException('The option "subject" must be set for the EmailToApplicantFinisher.', 1648126462);
        }
        if (empty($recipientAddress)) {
            throw new FinisherException('The option "recipientAddress" must be set for the EmailToApplicantFinisher.', 1648126463);
        }
        if (empty($senderAddress)) {
            throw new FinisherException('The option "senderAddress" must be set for the EmailToApplicantFinisher.', 1648126464);
        }

        $formRuntime = $this->finisherContext->getFormRuntime();

        $translationService = GeneralUtility::makeInstance(TranslationService::class);
        if (is_string($this->options['translation']['language'] ?? null) && $this->options['translation']['language'] !== '') {
            $languageBackup = $translationService->getLanguage();
            $translationService->setLanguage($this->options['translation']['language']);
        }

        $mail = $this
            ->initializeFluidEmail($formRuntime)
            ->format($addHtmlPart ? FluidEmail::FORMAT_BOTH : FluidEmail::FORMAT_PLAIN)
            ->assign('title', $title);

        $mail
            ->from(new Address($senderAddress, $senderName))
            ->to(new Address($recipientAddress, $recipientName))
            ->subject($subject);

        if (!empty($languageBackup)) {
            $translationService->setLanguage($languageBackup);
        }

        if ($attachUploads) {
            foreach ($formRuntime->getFormDefinition()->getRenderablesRecursively() as $element) {
                if (!$element instanceof FileUpload) {
                    continue;
                }
                $file = $formRuntime[$element->getIdentifier()];
                if ($file) {
                    if ($file instanceof FileReference) {
                        $file = $file->getOriginalResource();
                    }
                    $mail->attach($file->getContents(), $file->getName(), $file->getMimeType());
                }
            }
        }

        GeneralUtility::makeInstance(Mailer::class)->send($mail);
    }

    /**
     * @param FormRuntime $formRuntime
     * @return FluidEmail
     */
    protected function initializeFluidEmail(FormRuntime $formRuntime): FluidEmail
    {
        $templateConfiguration = $GLOBALS['TYPO3_CONF_VARS']['MAIL'];

        if (is_array($this->options['templateRootPaths'] ?? null)) {
            $templateConfiguration['templateRootPaths'] = array_replace_recursive(
                $templateConfiguration['templateRootPaths'],
                $this->options['templateRootPaths']
            );
            ksort($templateConfiguration['templateRootPaths']);
        }

        if (is_array($this->options['partialRootPaths'] ?? null)) {
            $templateConfiguration['partialRootPaths'] = array_replace_recursive(
                $templateConfiguration['partialRootPaths'],
                $this->options['partialRootPaths']
            );
            ksort($templateConfiguration['partialRootPaths']);
        }

        if (is_array($this->options['layoutRootPaths'] ?? null)) {
            $templateConfiguration['layoutRootPaths'] = array_replace_recursive(
                $templateConfiguration['layoutRootPaths'],
                $this->options['layoutRootPaths']
            );
            ksort($templateConfiguration['layoutRootPaths']);
        }

        $fluidEmail = GeneralUtility::makeInstance(
            FluidEmail::class,
            GeneralUtility::makeInstance(TemplatePaths::class, $templateConfiguration)
        );

        if (!isset($this->options['templateName']) || $this->options['templateName'] === '') {
            throw new FinisherException('The option "templateName" must be set to use FluidEmail.', 1599834020);
        }

        // Set the PSR-7 request object if available
        if (($GLOBALS['TYPO3_REQUEST'] ?? null) instanceof ServerRequestInterface) {
            $fluidEmail->setRequest($GLOBALS['TYPO3_REQUEST']);
        }

        $fluidEmail
            ->setTemplate($this->options['templateName'])
            ->assignMultiple([
                'finisherVariableProvider' => $this->finisherContext->getFinisherVariableProvider(),
                'form' => $formRuntime,
            ]);

        if (is_array($this->options['variables'] ?? null)) {
            $fluidEmail->assignMultiple($this->options['variables']);
        }

        $fluidEmail
            ->getViewHelperVariableContainer()
            ->addOrUpdate(RenderRenderableViewHelper::class, 'formRuntime', $formRuntime);

        return $fluidEmail;
    }
}
