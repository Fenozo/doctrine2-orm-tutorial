<?php
# src/Entity/Participation.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="participations",uniqueConstraints={
        @ORM\UniqueConstraint(name="user_poll_unique", columns={"user_id", "poll_id"})
    })
*/
class Participation
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**
    * @ORM\Column(type="datetime")
    */
    protected $date;

    /**
    * @ORM\ManyToOne(targetEntity=User::class, inversedBy="participations")
    */
    protected $user;

    /**
    * @ORM\ManyToOne(targetEntity=Poll::class)
    */
    protected $poll;

    public function __toString()
    {
        $format = "Participation (Id: %s, %s, %s)\n";
        return sprintf($format, $this->id, $this->user, $this->poll);
    }
    
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of poll
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * Set the value of poll
     *
     * @return  self
     */
    public function setPoll($poll)
    {
        $this->poll = $poll;

        return $this;
    }
}
