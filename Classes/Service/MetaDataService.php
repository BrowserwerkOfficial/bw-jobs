<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Service;

use Browserwerk\BwJobs\Domain\Model\JobPosition;
use Browserwerk\BwJobs\PageTitle\PageTitleProvider;
use TYPO3\CMS\Core\MetaTag\MetaTagManagerRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

/**
 * MetaDataService
 */
class MetaDataService
{
    /**
     * pageTitleProvider
     *
     * @var PageTitleProvider
     */
    protected $pageTitleProvider;

    /**
     * metaTagManagerRegistry
     *
     * @var MetaTagManagerRegistry
     */
    protected $metaTagManagerRegistry;

    /**
     * @param PageTitleProvider $pageTitleProvider
     */
    public function injectpageTitleProvider(PageTitleProvider $pageTitleProvider)
    {
        $this->pageTitleProvider = $pageTitleProvider;
    }

    /**
     * @param MetaTagManagerRegistry $metaTagManagerRegistry
     */
    public function injectMetaTagManagerRegistry(MetaTagManagerRegistry $metaTagManagerRegistry)
    {
        $this->metaTagManagerRegistry = $metaTagManagerRegistry;
    }

    /**
     * Injects seo meta tags for a job position
     *
     * @param JobPosition $jobPosition
     */
    protected function injectSeoTags(JobPosition $jobPosition)
    {
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
    }

    /**
     * Injects open graph meta tags for a job position
     *
     * @param JobPosition $jobPosition
     */
    protected function injectOgTags(JobPosition $jobPosition)
    {
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
    }

    /**
     * Injects twitter meta tags for a job position
     *
     * @param JobPosition $jobPosition
     */
    protected function injectTwitterTags(JobPosition $jobPosition)
    {
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

    /**
     * Set the page title for a job position
     *
     * @param JobPosition $jobPosition
     */
    public function setTitleForJobPosition(JobPosition $jobPosition)
    {
        $title = $jobPosition->getTitle();
        $seoTitle = $jobPosition->getSeoTitle();

        $this->pageTitleProvider->setTitle($seoTitle ?: $title);
    }

    /**
     * Injects various meta tags for a job position
     *
     * @param JobPosition $jobPosition
     */
    public function injectMetaForJobPosition(JobPosition $jobPosition)
    {
        $this->injectSeoTags($jobPosition);
        $this->injectOgTags($jobPosition);
        $this->injectTwitterTags($jobPosition);
    }
}
