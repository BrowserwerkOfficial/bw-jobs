<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Domain\Model;

use DateTime;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

/**
 * JobPosition
 */
class JobPosition extends AbstractEntity
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * slug
     *
     * @var string
     */
    protected $slug = '';

    /**
     * teaser
     *
     * @var string
     */
    protected $teaser = '';

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * requiredEducation
     *
     * @var string
     */
    protected $requiredEducation = '';

    /**
     * educationCategories
     *
     * @var string
     */
    protected $educationCategories = '';

    /**
     * requiredExperience
     *
     * @var string
     */
    protected $requiredExperience = '';

    /**
     * requiredQualifications
     *
     * @var string
     */
    protected $requiredQualifications = '';

    /**
     * requiredResponsibilities
     *
     * @var string
     */
    protected $requiredResponsibilities = '';

    /**
     * requiredSkills
     *
     * @var string
     */
    protected $requiredSkills = '';

    /**
     * requiredCommitments
     *
     * @var string
     */
    protected $requiredCommitments = '';

    /**
     * benefits
     *
     * @var string
     */
    protected $benefits = '';

    /**
     * workHours
     *
     * @var int
     */
    protected $workHours = 0;

    /**
     * startDate
     *
     * @var DateTime
     */
    protected $startDate;

    /**
     * validThroughDate
     *
     * @var DateTime
     */
    protected $validThroughDate;

    /**
     * salaryPublic
     *
     * @var bool
     */
    protected $salaryPublic = false;

    /**
     * salary
     *
     * @var int
     */
    protected $salary = 0;

    /**
     * homeofficePublic
     *
     * @var bool
     */
    protected $homeofficePublic = false;

    /**
     * homeofficePossible
     *
     * @var bool
     */
    protected $homeofficePossible = false;

    /**
     * directApplicationPossible
     *
     * @var bool
     */
    protected $directApplicationPossible = false;

    /**
     * currency
     *
     * @var string
     */
    protected $currency = '';

    /**
     * paymentCycle
     *
     * @var string
     */
    protected $paymentCycle = '';

    /**
     * level
     *
     * @var string
     */
    protected $level = '';

    /**
     * datePosted
     *
     * @var DateTime
     */
    protected $datePosted;

    /**
     * seoTitle
     *
     * @var string
     */
    protected $seoTitle;

    /**
     * seoDescription
     *
     * @var string
     */
    protected $seoDescription;

    /**
     * ogTitle
     *
     * @var string
     */
    protected $ogTitle;

    /**
     * ogDescription
     *
     * @var string
     */
    protected $ogDescription;

    /**
     * ogImage
     *
     * @var FileReference
     */
    protected $ogImage;

    /**
     * twitterTitle
     *
     * @var string
     */
    protected $twitterTitle;

    /**
     * twitterDescription
     *
     * @var string
     */
    protected $twitterDescription;

    /**
     * twitterImage
     *
     * @var FileReference
     */
    protected $twitterImage;

    /**
     * twitterCard
     *
     * @var string
     */
    protected $twitterCard;

    /**
     * employmentTypesPublic
     *
     * @var bool
     */
    protected $employmentTypesPublic = false;

    /**
     * employmentTypes
     *
     * @var ObjectStorage<EmploymentType>
     */
    protected $employmentTypes;

    /**
     * locations
     *
     * @var ObjectStorage<Location>
     */
    protected $locations;

    /**
     * categoriesPublic
     *
     * @var bool
     */
    protected $categoriesPublic = false;

    /**
     * categories
     *
     * @var ObjectStorage<Category>
     */
    protected $categories;

    /**
     * headlinesVisible
     *
     * @var bool
     */
    protected $headlinesVisible = false;

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Returns the slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the slug
     *
     * @param string $slug
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * Returns the teaser
     *
     * @return string $teaser
     */
    public function getTeaser()
    {
        return $this->teaser;
    }

    /**
     * Sets the teaser
     *
     * @param string $teaser
     */
    public function setTeaser(string $teaser)
    {
        $this->teaser = $teaser;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Returns the requiredEducation
     *
     * @return string $requiredEducation
     */
    public function getRequiredEducation()
    {
        return $this->requiredEducation;
    }

    /**
     * Sets the requiredEducation
     *
     * @param string $requiredEducation
     */
    public function setRequiredEducation(string $requiredEducation)
    {
        $this->requiredEducation = $requiredEducation;
    }

    /**
     * Returns the educationCategories
     *
     * @return string $educationCategories
     */
    public function getEducationCategories()
    {
        return $this->educationCategories;
    }

    /**
     * Sets the educationCategories
     *
     * @param string $educationCategories
     */
    public function setEducationCategories(string $educationCategories)
    {
        $this->educationCategories = $educationCategories;
    }

    /**
     * Returns the requiredExperience
     *
     * @return string $requiredExperience
     */
    public function getRequiredExperience()
    {
        return $this->requiredExperience;
    }

    /**
     * Sets the requiredExperience
     *
     * @param string $requiredExperience
     */
    public function setRequiredExperience(string $requiredExperience)
    {
        $this->requiredExperience = $requiredExperience;
    }

    /**
     * Returns the requiredQualifications
     *
     * @return string $requiredQualifications
     */
    public function getRequiredQualifications()
    {
        return $this->requiredQualifications;
    }

    /**
     * Sets the requiredQualifications
     *
     * @param string $requiredQualifications
     */
    public function setRequiredQualifications(string $requiredQualifications)
    {
        $this->requiredQualifications = $requiredQualifications;
    }

    /**
     * Returns the requiredResponsibilities
     *
     * @return string $requiredResponsibilities
     */
    public function getRequiredResponsibilities()
    {
        return $this->requiredResponsibilities;
    }

    /**
     * Sets the requiredResponsibilities
     *
     * @param string $requiredResponsibilities
     */
    public function setRequiredResponsibilities(string $requiredResponsibilities)
    {
        $this->requiredResponsibilities = $requiredResponsibilities;
    }

    /**
     * Returns the requiredSkills
     *
     * @return string $requiredSkills
     */
    public function getRequiredSkills()
    {
        return $this->requiredSkills;
    }

    /**
     * Sets the requiredSkills
     *
     * @param string $requiredSkills
     */
    public function setRequiredSkills(string $requiredSkills)
    {
        $this->requiredSkills = $requiredSkills;
    }

    /**
     * Returns the requiredCommitments
     *
     * @return string $requiredCommitments
     */
    public function getRequiredCommitments()
    {
        return $this->requiredCommitments;
    }

    /**
     * Sets the requiredCommitments
     *
     * @param string $requiredCommitments
     */
    public function setRequiredCommitments(string $requiredCommitments)
    {
        $this->requiredCommitments = $requiredCommitments;
    }

    /**
     * Returns the benefits
     *
     * @return string $benefits
     */
    public function getBenefits()
    {
        return $this->benefits;
    }

    /**
     * Sets the benefits
     *
     * @param string $benefits
     */
    public function setBenefits(string $benefits)
    {
        $this->benefits = $benefits;
    }

    /**
     * Returns the workHours
     *
     * @return int $workHours
     */
    public function getWorkHours()
    {
        return $this->workHours;
    }

    /**
     * Sets the workHours
     *
     * @param int $workHours
     */
    public function setWorkHours(int $workHours)
    {
        $this->workHours = $workHours;
    }

    /**
     * Returns the startDate
     *
     * @return DateTime $startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Sets the startDate
     *
     * @param DateTime $startDate
     */
    public function setStartDate(DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * Returns the validThroughDate
     *
     * @return DateTime $validThroughDate
     */
    public function getValidThroughDate()
    {
        return $this->validThroughDate;
    }

    /**
     * Sets the validThroughDate
     *
     * @param DateTime $validThroughDate
     */
    public function setValidThroughDate(DateTime $validThroughDate)
    {
        $this->validThroughDate = $validThroughDate;
    }

    /**
     * Returns the salaryPublic
     *
     * @return bool $salaryPublic
     */
    public function getSalaryPublic()
    {
        return $this->salaryPublic;
    }

    /**
     * Returns the boolean state of salaryPublic
     *
     * @return bool
     */
    public function isSalaryPublic()
    {
        return $this->salaryPublic;
    }

    /**
     * Sets the salaryPublic
     *
     * @param bool $salaryPublic
     */
    public function setSalaryPublic(bool $salaryPublic)
    {
        $this->salaryPublic = $salaryPublic;
    }

    /**
     * Returns the salary
     *
     * @return int $salary
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Sets the salary
     *
     * @param int $salary
     */
    public function setSalary(int $salary)
    {
        $this->salary = $salary;
    }

    /**
     * Returns the homeofficePublic
     *
     * @return bool $homeofficePublic
     */
    public function getHomeofficePublic()
    {
        return $this->homeofficePublic;
    }

    /**
     * Returns the boolean state of homeofficePublic
     *
     * @return bool
     */
    public function isHomeofficePublic()
    {
        return $this->homeofficePublic;
    }

    /**
     * Returns the homeofficePossible
     *
     * @return bool $homeofficePossible
     */
    public function getHomeofficePossible()
    {
        return $this->homeofficePossible;
    }

    /**
     * Returns the boolean state of homeofficePossible
     *
     * @return bool
     */
    public function isHomeofficePossible()
    {
        return $this->homeofficePossible;
    }

    /**
     * Sets the homeofficePossible
     *
     * @param bool $homeofficePossible
     */
    public function setHomeofficePossible(bool $homeofficePossible)
    {
        $this->homeofficePossible = $homeofficePossible;
    }

    /**
     * Returns the directApplicationPossible
     *
     * @return bool $directApplicationPossible
     */
    public function getDirectApplicationPossible()
    {
        return $this->directApplicationPossible;
    }

    /**
     * Returns the boolean state of directApplicationPossible
     *
     * @return bool
     */
    public function isDirectApplicationPossible()
    {
        return $this->directApplicationPossible;
    }

    /**
     * Sets the directApplicationPossible
     *
     * @param bool $directApplicationPossible
     */
    public function setDirectApplicationPossible(bool $directApplicationPossible)
    {
        $this->directApplicationPossible = $directApplicationPossible;
    }

    /**
     * Returns the currency
     *
     * @return string $currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Sets the currency
     *
     * @param string $currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * Returns the paymentCycle
     *
     * @return string $paymentCycle
     */
    public function getPaymentCycle()
    {
        return $this->paymentCycle;
    }

    /**
     * Sets the paymentCycle
     *
     * @param string $paymentCycle
     */
    public function setPaymentCycle(string $paymentCycle)
    {
        $this->paymentCycle = $paymentCycle;
    }

    /**
     * Returns the level
     *
     * @return string $level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Sets the level
     *
     * @param string $level
     */
    public function setLevel(string $level)
    {
        $this->level = $level;
    }

    /**
     * Returns the datePosted
     *
     * @return DateTime $datePosted
     */
    public function getDatePosted()
    {
        return $this->datePosted;
    }

    /**
     * Sets the datePosted
     *
     * @param DateTime $datePosted
     */
    public function setDatePosted(DateTime $datePosted)
    {
        $this->datePosted = $datePosted;
    }

    /**
     * Returns the seoTitle
     *
     * @return string $seoTitle
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * Sets the seoTitle
     *
     * @param string $seoTitle
     */
    public function setSeoTitle(string $seoTitle)
    {
        $this->seoTitle = $seoTitle;
    }

    /**
     * Returns the seoDescription
     *
     * @return string $seoDescription
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * Sets the seoDescription
     *
     * @param string $seoDescription
     */
    public function setSeoDescription(string $seoDescription)
    {
        $this->seoDescription = $seoDescription;
    }

    /**
     * Returns the ogTitle
     *
     * @return string $ogTitle
     */
    public function getOgTitle()
    {
        return $this->ogTitle;
    }

    /**
     * Sets the ogTitle
     *
     * @param string $ogTitle
     */
    public function setOgTitle(string $ogTitle)
    {
        $this->ogTitle = $ogTitle;
    }

    /**
     * Returns the ogDescription
     *
     * @return string $ogDescription
     */
    public function getOgDescription()
    {
        return $this->ogDescription;
    }

    /**
     * Sets the ogDescription
     *
     * @param string $ogDescription
     */
    public function setOgDescription(string $ogDescription)
    {
        $this->ogDescription = $ogDescription;
    }

    /**
     * Returns the ogImage
     *
     * @return FileReference $ogImage
     */
    public function getOgImage()
    {
        return $this->ogImage;
    }

    /**
     * Sets the ogImage
     *
     * @param FileReference $ogImage
     */
    public function setOgImage(FileReference $ogImage)
    {
        $this->ogImage = $ogImage;
    }

    /**
     * Returns the twitterTitle
     *
     * @return string $twitterTitle
     */
    public function getTwitterTitle()
    {
        return $this->twitterTitle;
    }

    /**
     * Sets the twitterTitle
     *
     * @param string $twitterTitle
     */
    public function setTwitterTitle(int $twitterTitle)
    {
        $this->twitterTitle = $twitterTitle;
    }

    /**
     * Returns the twitterDescription
     *
     * @return string $twitterDescription
     */
    public function getTwitterDescription()
    {
        return $this->twitterDescription;
    }

    /**
     * Sets the twitterDescription
     *
     * @param string $twitterDescription
     */
    public function setTwitterDescription(int $twitterDescription)
    {
        $this->twitterDescription = $twitterDescription;
    }

    /**
     * Returns the twitterImage
     *
     * @return FileReference $twitterImage
     */
    public function getTwitterImage()
    {
        return $this->twitterImage;
    }

    /**
     * Sets the twitterImage
     *
     * @param FileReference $twitterImage
     */
    public function setTwitterImage(FileReference $twitterImage)
    {
        $this->twitterImage = $twitterImage;
    }

    /**
     * Returns the twitterCard
     *
     * @return string $twitterCard
     */
    public function getTwitterCard()
    {
        return $this->twitterCard;
    }

    /**
     * Sets the twitterCard
     *
     * @param string $twitterCard
     */
    public function setTwitterCard(string $twitterCard)
    {
        $this->twitterCard = $twitterCard;
    }

    /**
     * Returns the employmentTypesPublic
     *
     * @return bool $employmentTypesPublic
     */
    public function getEmploymentTypesPublic()
    {
        return $this->employmentTypesPublic;
    }

    /**
     * Returns the boolean state of employmentTypesPublic
     *
     * @return bool
     */
    public function isEmploymentTypesPublic()
    {
        return $this->employmentTypesPublic;
    }

    /**
     * Sets the employmentTypesPublic
     *
     * @param bool $employmentTypesPublic
     */
    public function setEmploymentTypesPublic(bool $employmentTypesPublic)
    {
        $this->employmentTypesPublic = $employmentTypesPublic;
    }

    /**
     * Adds a EmploymentType
     *
     * @param EmploymentType $employmentType
     */
    public function addEmploymentType(EmploymentType $employmentType)
    {
        $this->employmentTypes->attach($employmentType);
    }

    /**
     * Removes a EmploymentType
     *
     * @param EmploymentType $employmentTypeToRemove The EmploymentType to be removed
     */
    public function removeEmploymentType(EmploymentType $employmentTypeToRemove)
    {
        $this->employmentTypes->detach($employmentTypeToRemove);
    }

    /**
     * Returns the employmentTypes
     *
     * @return ObjectStorage<EmploymentType>
     */
    public function getEmploymentTypes()
    {
        return $this->employmentTypes;
    }

    /**
     * Returns the first employmentType
     *
     * @return EmploymentType
     */
    public function getFirstEmploymentType()
    {
        return $this->employmentTypes[0];
    }

    /**
     * Sets the employmentTypes
     *
     * @param ObjectStorage<EmploymentType> $employmentTypes
     */
    public function setEmploymentTypes(ObjectStorage $employmentTypes)
    {
        $this->employmentTypes = $employmentTypes;
    }

    /**
     * Adds a location
     *
     * @param Location $location
     */
    public function addLocation(Location $location)
    {
        $this->locations->attach($location);
    }

    /**
     * Removes a location
     *
     * @param Location $locationToRemove The location to be removed
     */
    public function removeLocation(Location $locationToRemove)
    {
        $this->locations->detach($locationToRemove);
    }

    /**
     * Returns the locations
     *
     * @return ObjectStorage<Location>
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Returns the first location
     *
     * @return Location
     */
    public function getFirstLocation()
    {
        return $this->locations[0];
    }

    /**
     * Sets the locations
     *
     * @param ObjectStorage<Location> $locations
     */
    public function setLocations(ObjectStorage $locations)
    {
        $this->locations = $locations;
    }

    /**
     * Returns the categoriesPublic
     *
     * @return bool $categoriesPublic
     */
    public function getCategoriesPublic()
    {
        return $this->categoriesPublic;
    }

    /**
     * Returns the boolean state of categoriesPublic
     *
     * @return bool
     */
    public function isCategoriesPublic()
    {
        return $this->categoriesPublic;
    }

    /**
     * Adds a category
     *
     * @param Category $category
     */
    public function addCategory(Category $category)
    {
        $this->categories->attach($category);
    }

    /**
     * Removes a category
     *
     * @param Category $categoryToRemove The category to be removed
     */
    public function removeCategory(Category $categoryToRemove)
    {
        $this->categories->detach($categoryToRemove);
    }

    /**
     * Returns the categories
     *
     * @return ObjectStorage<Category>
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Returns the first category
     *
     * @return Category|null
     */
    public function getFirstCategory()
    {
        return $this->categories[0];
    }

    /**
     * Sets the categories
     *
     * @param ObjectStorage<Category> $categories
     */
    public function setCategories(ObjectStorage $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Returns the headlinesVisible
     *
     * @return bool $headlinesVisible
     */
    public function getHeadlinesVisible()
    {
        return $this->headlinesVisible;
    }

    /**
     * Returns the boolean state of headlinesVisible
     *
     * @return bool
     */
    public function isHeadlinesVisible()
    {
        return $this->headlinesVisible;
    }
}
