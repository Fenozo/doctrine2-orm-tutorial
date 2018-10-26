<?php
# src/Entity/Address.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="addresses")
*/
class Address
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**
    * @ORM\Column(type="string")
    */
    protected $street;

    /**
    * @ORM\Column(type="string")
    */
    protected $city;

    /**
    * @ORM\Column(type="string", name="country")
    */
    protected $country;

    public function __toString()
    {
        $format = "Address (id: %s, street: %s, city: %s, country: %s)";
        return sprintf($format, $this->id, $this->street, $this->city, $this->country);
    }

    /**
     * @return int id
    */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set street
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * get street
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * set city
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * get city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * set country
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * get Country
     */
    public function getCountry()
    {
        return $this->country;
    }
}
