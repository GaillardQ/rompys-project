<?php

namespace Frontend\FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="Frontend\FrontOfficeBundle\Entity\AddressRepository")
 */
class Address {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="number_street", type="string", length=45, nullable=false)
     */
    private $number_street;

    /**
     * @var string
     *
     * @ORM\Column(name="additionnal_address_1", type="string", length=255, nullable=true)
     */
    private $additionnal_address_1;

    /**
     * @var string
     *
     * @ORM\Column(name="additionnal_address_2", type="string", length=255, nullable=true)
     */
    private $additionnal_address_2;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=45, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=45, nullable=true)
     */
    private $zip_code;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=45, nullable=false)
     */
    private $country;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set numberStreet
     *
     * @param string $numberStreet
     * @return Address
     */
    public function setNumberStreet($numberStreet) {
        $this->number_street = $numberStreet;

        return $this;
    }

    /**
     * Get numberStreet
     *
     * @return string 
     */
    public function getNumberStreet() {
        return $this->number_street;
    }

    /**
     * Set additionnalAddress1
     *
     * @param string $additionnalAddress1
     * @return Address
     */
    public function setAdditionnalAddress1($additionnalAddress1) {
        $this->additionnal_address_1 = $additionnalAddress1;

        return $this;
    }

    /**
     * Get additionnalAddress1
     *
     * @return string 
     */
    public function getAdditionnalAddress1() {
        return $this->additionnal_address_1;
    }

    /**
     * Set additionnalAddress2
     *
     * @param string $additionnalAddress2
     * @return Address
     */
    public function setAdditionnalAddress2($additionnalAddress2) {
        $this->additionnal_address_2 = $additionnalAddress2;

        return $this;
    }

    /**
     * Get additionnalAddress2
     *
     * @return string 
     */
    public function getAdditionnalAddress2() {
        return $this->additionnal_address_2;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city) {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     * @return Address
     */
    public function setZipCode($zipCode) {
        $this->zip_code = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string 
     */
    public function getZipCode() {
        return $this->zip_code;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Address
     */
    public function setCountry($country) {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry() {
        return $this->country;
    }

}
