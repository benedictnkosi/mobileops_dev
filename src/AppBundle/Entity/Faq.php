<?php



/**
 * Faq
 */
class Faq
{
    /**
     * @var string
     */
    private $question;

    /**
     * @var string
     */
    private $answer;

    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var integer
     */
    private $faqId;


    /**
     * Set question
     *
     * @param string $question
     *
     * @return Faq
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return Faq
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Faq
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get faqId
     *
     * @return integer
     */
    public function getFaqId()
    {
        return $this->faqId;
    }
}


