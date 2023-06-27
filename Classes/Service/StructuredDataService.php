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
        $addressLocality = $location->getCity();
        $addressRegion = $location->getRegion();
        $postalCode = $location->getZip();
        $addressCountry = $location->getCountryZone();
        $homeofficePossible = $jobPosition->getHomeofficePossible();

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

        if ($homeofficePossible) {
            $result['jobLocationType'] = 'TELECOMMUTE';
            if (!empty($addressCountry)) {
                $result['applicantLocationRequirements'] = [
                    '@type' => 'Country',
                    'name' => $addressCountry,
                ];
            }
        } else {
            $result['jobLocationType'] = 'IN_PERSON';
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
        $sameAs = $siteUrl;
        $logo = $location->getImage();

        if (!empty($name)) {
            if (!isset($result['hiringOrganization'])) {
                $result['hiringOrganization'] = [
                    '@type' => 'Organization',
                ];
            }

            $result['hiringOrganization']['name'] = $name;
        }

        if (!empty($sameAs)) {
            if (!isset($result['hiringOrganization'])) {
                $result['hiringOrganization'] = [
                    '@type' => 'Organization',
                ];
            }

            $result['hiringOrganization']['sameAs'] = $sameAs;
        }

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
        $value = $jobPosition->getSalary();
        $unitText = $this->getUnitTextForPaymentCycle($jobPosition->getPaymentCycle());

        if (!empty($currency)) {
            if (!isset($result['baseSalary'])) {
                $result['baseSalary'] = [
                    '@type' => 'MonetaryAmount',
                ];
            }

            $result['baseSalary']['currency'] = $currency;
        }

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
        $title = $jobPosition->getTitle();
        $description = $jobPosition->getDescription();
        $datePosted = $jobPosition->getDatePosted();
        $validThrough = $jobPosition->getValidThroughDate();
        $jobBenefits = $jobPosition->getBenefits();
        $employmentType = $jobPosition->getFirstEmploymentType();
        $educationCategories = $jobPosition->getEducationCategories();
        $experienceRequirements = $jobPosition->getRequiredExperience();
        $responsibilities = $jobPosition->getRequiredResponsibilities();
        $requiredEducation = $jobPosition->getRequiredEducation();
        $directApply = $jobPosition->getDirectApplicationPossible();

        $result = [
            '@context' => 'http://schema.org',
            '@type' => 'JobPosting',
        ];

        if (!empty($title)) {
            $result['title'] = $title;
        }

        if (!empty($description)) {
            $result['description'] = $description;
        }

        if (!empty($datePosted)) {
            $result['datePosted'] = $datePosted->format('Y-m-d');
        }

        if (!empty($validThrough)) {
            $result['validThrough'] = $validThrough->format('Y-m-d');
        } else {
            $result['validThrough'] = (new \DateTime())->modify('+1 year')->format('Y-m-d');
        }

        if (!empty($employmentType)) {
            $result['employmentType'] = $employmentType->getType();
        }

        if (!empty($educationCategories)) {
            if (!isset($result['educationRequirements'])) {
                $result['educationRequirements'] = [];
            }

            foreach (explode(',', $educationCategories) as $educationCategory) {
                $data = [
                    '@type' => 'EducationalOccupationalCredential',
                    'credentialCategory' => $educationCategory,
                ];

                if (!empty($requiredEducation)) {
                    $data['competencyRequired'] = $requiredEducation;
                }

                $result['educationRequirements'][] = $data;
            }
        }

        if (!empty($experienceRequirements)) {
            $result['experienceRequirements'] = $experienceRequirements;
            $result['description'] .= '<br /><br />' . $experienceRequirements;
        }

        if (!empty($responsibilities)) {
            $result['responsibilities'] = $responsibilities;
            $result['description'] .= '<br /><br />' . $responsibilities;
        }

        if (!empty($jobBenefits)) {
            $result['jobBenefits'] = $jobBenefits;
            $result['description'] .= '<br /><br />' . $jobBenefits;
        }

        if (!empty($directApply)) {
            $result['directApply'] = $directApply;
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
