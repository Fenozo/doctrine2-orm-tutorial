<?php
# src/Entity/User.php

namespace App\Entity;


use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * 
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository") 
 *
 */
class User
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
    protected $firstname;

    /**
    * @ORM\Column(type="string")
    */
    protected $lastname;

    /**
    * @ORM\Column(type="string")
    */
    protected $role;

    /**
    *  @ORM\OneToOne(targetEntity=Address::class, cascade={"persist", "remove"}, fetch="EAGER")
    *  
    */
    protected $address;

    /**
    * @ORM\OneToMany(targetEntity=Participation::class, mappedBy="user")
    */
    protected $participations;

    public function __construct() {
        $this->participations = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function __toString()
    {
        $format = "User (id: %s, firstname: %s, lastname: %s, role: %s)\n";
        return sprintf($format, $this->id, $this->firstname, $this->lastname, $this->role,$this->address);
    }

    public function setAddress($address = null) {
        $this->address = $address;
        return $this;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }
}