<?php

class MultipleChoiceQuestion extends Question
{
    private int $trueAnswer;
    private string $answer1;
    private string $answer2;
    private string $answer3;

    /**
     * @param int $trueAnswer
     * @param string $answer1
     * @param string $answer2
     * @param string $answer3
     */
    public function __construct(int $id, string $module, string $description, string $question, int $trueAnswer, string $answer1, string $answer2, string $answer3)
    {
        parent::__construct($id, $module, $description, $question);
        $this->trueAnswer = $trueAnswer;
        $this->answer1 = $answer1;
        $this->answer2 = $answer2;
        $this->answer3 = $answer3;
    }


    /**
     * @return int
     */
    public function getTrueAnswer(): int
    {
        return $this->trueAnswer;
    }

    /**
     * @param int $trueAnswer
     */
    public function setTrueAnswer(int $trueAnswer): void
    {
        $this->trueAnswer = $trueAnswer;
    }

    /**
     * @return string
     */
    public function getAnswer1(): string
    {
        return $this->answer1;
    }

    /**
     * @param string $answer1
     */
    public function setAnswer1(string $answer1): void
    {
        $this->answer1 = $answer1;
    }

    /**
     * @return string
     */
    public function getAnswer2(): string
    {
        return $this->answer2;
    }

    /**
     * @param string $answer2
     */
    public function setAnswer2(string $answer2): void
    {
        $this->answer2 = $answer2;
    }

    /**
     * @return string
     */
    public function getAnswer3(): string
    {
        return $this->answer3;
    }

    /**
     * @param string $answer3
     */
    public function setAnswer3(string $answer3): void
    {
        $this->answer3 = $answer3;
    }



}