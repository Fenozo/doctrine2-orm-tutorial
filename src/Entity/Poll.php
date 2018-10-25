<?php
# src/Entity/Poll.php

namespace Tuto\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="polls")
*/
class Poll
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
    protected $title;

    /**
    * @ORM\Column(type="datetime")
    */
    protected $created;

   /**
    * @ORM\OneToMany(targetEntity=Question::class, mappedBy="poll")
    */
    protected $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function __toString()
    {
        $format = "Poll (id: %s, title: %s, created: %s)\n";
        return sprintf($format, $this->id, $this->title, $this->created->format(\Datetime::ISO8601));
    }

    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of questions
     */ 
    public function getQuestions()
    {
        return $this->questions;
    }
    /**
     * 
     */
    public function addQuestion(Question $question)
    {
        // Toujours maintenir la relation cohérente
        $this->questions->add($question);
        $question->setPoll($this);
    }


    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of created
     */ 
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set the value of created
     *
     * @return  self
     */ 
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    
}