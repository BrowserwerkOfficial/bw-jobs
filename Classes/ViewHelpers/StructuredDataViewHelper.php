<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\ViewHelpers;

use Browserwerk\BwJobs\Domain\Model\JobPosition;
use Browserwerk\BwJobs\Service\StructuredDataService;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

/**
 * StructuredDataViewHelper
 */
class StructuredDataViewHelper extends AbstractTagBasedViewHelper
{
    /**
     * structuredDataService
     *
     * @var StructuredDataService
     */
    protected $structuredDataService;

    /**
     * tagName
     *
     * @var string
     */
    protected $tagName = 'script';

    /**
     * @param StructuredDataService $structuredDataService
     */
    public function injectStructuredDataService(StructuredDataService $structuredDataService)
    {
        $this->structuredDataService = $structuredDataService;
    }

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        $this->registerArgument(
            'jobPosition',
            JobPosition::class,
            'The job position to generate structured data for',
            true
        );
    }

    /**
     * @return string
     */
    public function render(): string
    {
        /* @var \Browserwerk\BwJobs\Domain\Model\JobPosition $jobPosition */
        $jobPosition = $this->arguments['jobPosition'];

        $structuredData = $this->structuredDataService->generateForJobPosition($jobPosition);

        $this->tag->addAttribute('type', 'application/ld+json');
        $this->tag->setContent(json_encode($structuredData));

        return $this->tag->render();
    }
}
