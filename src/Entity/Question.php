<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="questions")
 */
class Question
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
    protected $wording;

    /**
    * @ORM\OneToMany(targetEntity=Answer::class, cascade={"persist", "remove"}, mappedBy="question")
    */
    protected $answers;

    /**
    * @ORM\ManyToOne(targetEntity=Poll::class, inversedBy="questions")
    */
    protected $poll;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    public function __toString()
    {
        $format = "Question (id: %s, wording: %s) \n";

        return sprintf($format, $this->id, $this->wording);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of wording
     * @return  self
     */
    public function setWording($wording)
    {
        $this->wording = $wording;
        return $this;
    }

    /**
     * Get the value of wording
     */
    public function getWording()
    {
        return $this->wording;
    }

    public function getAnswers()
    {
        return $this->answers;
    }
    public function addAnswer(Answer $answer)
    {
        $this->answers->add($answer);
        $answer->setQuestion($this);
    }

    /**
     * Set the value of poll
     * @return  self
     */
    public function setPoll($poll)
    {
        $this->poll = $poll;

        return $this;
    }
}
