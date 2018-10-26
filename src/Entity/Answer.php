<?php
# src/Entity/Answer.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="answers")
*/
class Answer
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
    * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="answers")
    */
    protected $question;

    public function __toString()
    {
        $format = "Answer (id: %s, wording: %s)\n";
        return sprintf($format, $this->id, $this->wording);
    }
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
    // getters et setters

    /**
     * Get the value of question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set the value of question
     *
     * @return  self
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get the value of wording
     */
    public function getWording()
    {
        return $this->wording;
    }

    /**
     * Set the value of wording
     *
     * @return  self
     */
    public function setWording($wording)
    {
        $this->wording = $wording;

        return $this;
    }
}
