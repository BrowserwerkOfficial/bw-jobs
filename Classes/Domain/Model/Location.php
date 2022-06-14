<?php

declare(strict_types=1);

namespace Browserwerk\BwJobs\Domain\Model;

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
 * Location
 */
class Location extends AbstractEntity
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * organization
     *
     * @var string
     */
    protected $organization = '';

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * street
     *
     * @var string
     */
    protected $street = '';

    /**
     * city
     *
     * @var string
     */
    protected $city = '';

    /**
     * zip
     *
     * @var string
     */
    protected $zip = '';

    /**
     * region
     *
     * @var string
     */
    protected $region = '';

    /**
     * country
     *
     * @var string
     */
    protected $country = '';

    /**
     * countryZone
     *
     * @var string
     */
    protected $countryZone = '';

    /**
     * image
     *
     * @var FileReference
     */
    protected $image;

    /**
     * contactPersons
     *
     * @var ObjectStorage<ContactPerson>
     */
    protected $contactPersons;

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
     * Returns the organization
     *
     * @return string $organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Sets the organization
     *
     * @param string $organization
     */
    public function setOrganization(string $organization)
    {
        $this->organization = $organization;
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
     * Returns the street
     *
     * @return string $street
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Sets the street
     *
     * @param string $street
     */
    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    /**
     * Returns the city
     *
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the city
     *
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * Returns the zip
     *
     * @return string $zip
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Sets the zip
     *
     * @param string $zip
     */
    public function setZip(string $zip)
    {
        $this->zip = $zip;
    }

    /**
     * Returns the region
     *
     * @return string $region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Sets the region
     *
     * @param string $region
     */
    public function setRegion(string $region)
    {
        $this->region = $region;
    }

    /**
     * Returns the country
     *
     * @return string $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Sets the country
     *
     * @param string $country
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    /**
     * Returns the countryZone
     *
     * @return string $countryZone
     */
    public function getCountryZone()
    {
        return $this->countryZone;
    }

    /**
     * Sets the countryZone
     *
     * @param string $countryZone
     */
    public function setCountryZone(string $countryZone)
    {
        $this->countryZone = $countryZone;
    }

    /**
     * Returns the image
     *
     * @return FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param FileReference $image
     */
    public function setImage(FileReference $image)
    {
        $this->image = $image;
    }

    /**
     * Adds a contactPerson
     *
     * @param ContactPerson $contactPerson
     */
    public function addContactPerson(ContactPerson $contactPerson)
    {
        $this->contactPersons->attach($contactPerson);
    }

    /**
     * Removes a contactPerson
     *
     * @param ContactPerson $contactPersonToRemove The contactPerson to be removed
     */
    public function removeContactPerson(ContactPerson $contactPersonToRemove)
    {
        $this->contactPersons->detach($contactPersonToRemove);
    }

    /**
     * Returns the contactPersons
     *
     * @return ObjectStorage<ContactPerson>
     */
    public function getContactPersons()
    {
        return $this->contactPersons;
    }

    /**
     * Returns the first contactPerson
     *
     * @return ContactPerson|null
     */
    public function getFirstContactPerson()
    {
        return $this->contactPersons[0];
    }

    /**
     * Sets the contactPersons
     *
     * @param ObjectStorage<ContactPerson> $contactPersons
     */
    public function setContactPersons(ObjectStorage $contactPersons)
    {
        $this->contactPersons = $contactPersons;
    }
}
