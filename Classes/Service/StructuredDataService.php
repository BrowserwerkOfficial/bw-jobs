<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Service;

use Browserwerk\BwJobs\Domain\Model\JobPosition;
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
 * StructuredDataService
 */
class StructuredDataService
{
    /**
     * @param JobPosition $jobPosition
     * @param array $result
     * @return array
     */
    public function generateJobLocationData(JobPosition $jobPosition, array $result)
    {
        $location = $jobPosition->getFirstLocation();

        $streetAddress = $location->getStreet();
        if (!empty($streetAddress)) {
            if (!isset($result['jobLocation'])) {
                $result['jobLocation'] = [
                    '@type' => 'Place',
                    'address' => [
                        '@type' => 'PostalAddress',
                    ],
                ];
            }

            $result['jobLocation']['address']['streetAddress'] = $streetAddress;
        }

        $addressLocality = $location->getCity();
        if (!empty($addressLocality)) {
            if (!isset($result['jobLocation'])) {
                $result['jobLocation'] = [
                    '@type' => 'Place',
                    'address' => [
                        '@type' => 'PostalAddress',
                    ],
                ];
            }

            $result['jobLocation']['address']['addressLocality'] = $addressLocality;
        }

        $addressRegion = $location->getRegion();
        if (!empty($addressRegion)) {
            if (!isset($result['jobLocation'])) {
                $result['jobLocation'] = [
                    '@type' => 'Place',
                    'address' => [
                        '@type' => 'PostalAddress',
                    ],
                ];
            }

            $result['jobLocation']['address']['addressRegion'] = $addressRegion;
        }

        $postalCode = $location->getZip();
        if (!empty($postalCode)) {
            if (!isset($result['jobLocation'])) {
                $result['jobLocation'] = [
                    '@type' => 'Place',
                    'address' => [
                        '@type' => 'PostalAddress',
                    ],
                ];
            }

            $result['jobLocation']['address']['postalCode'] = $postalCode;
        }

        $addressCountry = $location->getCountryZone();
        if (!empty($addressCountry)) {
            if (!isset($result['jobLocation'])) {
                $result['jobLocation'] = [
                    '@type' => 'Place',
                    'address' => [
                        '@type' => 'PostalAddress',
                    ],
                ];
            }

            $result['jobLocation']['address']['addressCountry'] = $addressCountry;
        }

        return $result;
    }

    /**
     * @param JobPosition $jobPosition
     * @param array $result
     * @return array
     */
    public function generateHiringOrganizationData(JobPosition $jobPosition, array $result)
    {
        $location = $jobPosition->getFirstLocation();
        $siteUrl = GeneralUtility::getIndpEnv('TYPO3_SITE_URL');

        $name = $location->getOrganization();
        if (!empty($name)) {
            if (!isset($result['hiringOrganization'])) {
                $result['hiringOrganization'] = [
                    '@type' => 'Organization',
                ];
            }

            $result['hiringOrganization']['name'] = $name;
        }

        $sameAs = $siteUrl;
        if (!empty($sameAs)) {
            if (!isset($result['hiringOrganization'])) {
                $result['hiringOrganization'] = [
                    '@type' => 'Organization',
                ];
            }

            $result['hiringOrganization']['sameAs'] = $sameAs;
        }

        $logo = $location->getImage();
        if (!empty($logo)) {
            if (!isset($result['hiringOrganization'])) {
                $result['hiringOrganization'] = [
                    '@type' => 'Organization',
                ];
            }

            $result['hiringOrganization']['logo'] = GeneralUtility::locationHeaderUrl(
                $logo->getOriginalResource()->getPublicUrl()
            );
        }

        return $result;
    }

    /**
     * @param JobPosition $jobPosition
     * @param array $result
     * @return array
     */
    public function generateSalaryData(JobPosition $jobPosition, array $result)
    {
        $currency = $jobPosition->getCurrency();
        if (!empty($currency)) {
            if (!isset($result['baseSalary'])) {
                $result['baseSalary'] = [
                    '@type' => 'MonetaryAmount',
                ];
            }

            $result['baseSalary']['currency'] = $currency;
        }

        $value = $jobPosition->getSalary();
        if (!empty($value)) {
            if (!isset($result['baseSalary'])) {
                $result['baseSalary'] = [
                    '@type' => 'MonetaryAmount',
                ];
            }

            if (!isset($result['baseSalary']['value'])) {
                $result['baseSalary']['value'] = [
                    '@type' => 'QuantitativeValue',
                ];
            }

            $result['baseSalary']['value']['value'] = $value;
        }

        $unitText = $this->getUnitTextForPaymentCycle(
            $jobPosition->getPaymentCycle()
        );
        if (!empty($unitText)) {
            if (!isset($result['baseSalary'])) {
                $result['baseSalary'] = [
                    '@type' => 'MonetaryAmount',
                ];
            }

            if (!isset($result['baseSalary']['value'])) {
                $result['baseSalary']['value'] = [
                    '@type' => 'QuantitativeValue',
                ];
            }

            $result['baseSalary']['value']['unitText'] = $unitText;
        }

        return $result;
    }

    /**
     * @param JobPosition $jobPosition
     * @return array
     */
    public function generateForJobPosition(JobPosition $jobPosition): array
    {
        $result = [
            '@context' => 'http://schema.org',
            '@type' => 'JobPosting',
        ];

        $title = $jobPosition->getTitle();
        if (!empty($title)) {
            $result['title'] = $title;
        }

        $description = $jobPosition->getDescription();
        if (!empty($description)) {
            $result['description'] = $description;
        }

        $datePosted = $jobPosition->getDatePosted();
        if (!empty($datePosted)) {
            $result['datePosted'] = $datePosted->format('Y-m-d');
        }

        $validThrough = $jobPosition->getValidThroughDate();
        if (!empty($validThrough)) {
            $result['validThrough'] = $validThrough->format('Y-m-d');
        } else {
            $result['validThrough'] = (new \DateTime())->modify('+1 year')->format('Y-m-d');
        }

        $employmentType = $jobPosition->getFirstEmploymentType();
        if (!empty($employmentType)) {
            $result['employmentType'] = $employmentType->getType();
        }

        $educationCategories = $jobPosition->getEducationCategories();
        $requiredEducation = $jobPosition->getRequiredEducation();
        if (!empty($educationCategories)) {
            if (!isset($result['educationRequirements'])) {
                $result['educationRequirements'] = [];
            }

            foreach (explode(',', $educationCategories) as $educationCategory) {
                $data = [
                    '@type' => 'EducationalOccupationalCredential',
                    'credentialCategory' => $educationCategory
                ];

                if (!empty($requiredEducation)) {
                    $data['educationalLevel'] = $requiredEducation;
                }

                $result['educationRequirements'][] = $data;
            }
        }

        $result = $this->generateJobLocationData($jobPosition, $result);
        $result = $this->generateHiringOrganizationData($jobPosition, $result);
        $result = $this->generateSalaryData($jobPosition, $result);

        return $result;
    }

    /**
     * Maps the payment cycle to the unitText
     * expected by the structured data spec
     *
     * @param string $paymentCycle
     * @return string
     */
    public function getUnitTextForPaymentCycle(string $paymentCycle): string
    {
        $mapping = [
            'HOURLY' => 'HOUR',
            'DAILY' => 'DAY',
            'MONTHLY' => 'MONTH',
            'YEARLY' => 'YEAR',
        ];

        return $mapping[$paymentCycle];
    }
}
