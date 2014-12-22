<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="questions")
 */
class Question
{
    /**
     * Entity identifier.
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Question.
     *
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    private $question;

    /**
     * A guess if this question was answered as yes.
     *
     * @var string
     *
     * @ORM\Column(name="guess", type="string", length=64)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="64")
     */
    private $guess;

    /**
     * Next question if this one was answered yes.
     *
     * @var Question
     *
     * @ORM\OneToOne(targetEntity="Question", orphanRemoval=true)
     * @ORM\JoinColumn(name="next_question_yes", referencedColumnName="id", nullable=true)
     */
    private $nextQuestionYes;

    /**
     * Next question if this one was answered no.
     *
     * @var Question
     *
     * @ORM\OneToOne(targetEntity="Question", orphanRemoval=true)
     * @ORM\JoinColumn(name="next_question_no", referencedColumnName="id", nullable=true)
     */
    private $nextQuestionNo;

    /**
     * Get guess.
     *
     * @return string
     */
    public function getGuess()
    {
        return $this->guess;
    }

    /**
     * Set guess.
     *
     * @param string $guess
     *
     * @return Question
     */
    public function setGuess($guess)
    {
        $this->guess = $guess;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get next question for no.
     *
     * @return Question
     */
    public function getNextQuestionNo()
    {
        return $this->nextQuestionNo;
    }

    /**
     * Set next question for no.
     *
     * @param Question $nextQuestionNo
     *
     * @return Question
     */
    public function setNextQuestionNo(Question $nextQuestionNo)
    {
        $this->nextQuestionNo = $nextQuestionNo;

        return $this;
    }

    /**
     * Get next question for yes.
     *
     * @return Question
     */
    public function getNextQuestionYes()
    {
        return $this->nextQuestionYes;
    }

    /**
     * Set next question for yes.
     *
     * @param Question $nextQuestionYes
     *
     * @return Question
     */
    public function setNextQuestionYes(Question $nextQuestionYes)
    {
        $this->nextQuestionYes = $nextQuestionYes;

        return $this;
    }

    /**
     * Get question.
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set question.
     *
     * @param string $question
     *
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }
}
