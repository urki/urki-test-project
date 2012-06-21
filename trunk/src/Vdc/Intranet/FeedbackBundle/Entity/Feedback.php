<?php

namespace Vdc\Intranet\FeedbackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vdc\Intranet\FeedbackBundle\Entity\Feedback
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vdc\Intranet\FeedbackBundle\Entity\FeedbackRepository")
 */
class Feedback
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $type_id
     *
     * @ORM\Column(name="type_id", type="integer")
     */
    private $type_id;

    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", length=20)
     */
    private $status;

    /**
     * @var text $question
     *
     * @ORM\Column(name="question", type="text")
     */
    private $question;

    /**
     * @var text $answerproced
     *
     * @ORM\Column(name="answerproced", type="text")
     */
    private $answerproced;

    /**
     * @var text $answer
     *
     * @ORM\Column(name="answer", type="text")
     */
    private $answer;

    /**
     * @var integer $modified_by
     *
     * @ORM\Column(name="modified_by", type="integer")
     */
    private $modified_by;

    /**
     * @var datetime $modified_at
     *
     * @ORM\Column(name="modified_at", type="datetime")
     */
    private $modified_at;

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type_id
     *
     * @param integer $typeId
     */
    public function setTypeId($typeId)
    {
        $this->type_id = $typeId;
    }

    /**
     * Get type_id
     *
     * @return integer 
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set question
     *
     * @param text $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * Get question
     *
     * @return text 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answerproced
     *
     * @param text $answerproced
     */
    public function setAnswerproced($answerproced)
    {
        $this->answerproced = $answerproced;
    }

    /**
     * Get answerproced
     *
     * @return text 
     */
    public function getAnswerproced()
    {
        return $this->answerproced;
    }

    /**
     * Set answer
     *
     * @param text $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    /**
     * Get answer
     *
     * @return text 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set modified_by
     *
     * @param integer $modifiedBy
     */
    public function setModifiedBy($modifiedBy)
    {
        $this->modified_by = $modifiedBy;
    }

    /**
     * Get modified_by
     *
     * @return integer 
     */
    public function getModifiedBy()
    {
        return $this->modified_by;
    }

    /**
     * Set modified_at
     *
     * @param datetime $modifiedAt
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modified_at = $modifiedAt;
    }

    /**
     * Get modified_at
     *
     * @return datetime 
     */
    public function getModifiedAt()
    {
        return $this->modified_at;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
}