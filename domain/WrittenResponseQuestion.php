<?php

class WrittenResponseQuestion extends Question
{
    private string $trueAnswer;

    /**
     * @param string $trueAnswer
     */
    public function __construct(int $id, string $module, string $description, string $question, string $trueAnswer)
    {
        parent::__construct($id, $module, $description, $question);
        $this->trueAnswer = $trueAnswer;
    }


    /**
     * @return string
     */
    public function getTrueAnswer(): string
    {
        return $this->trueAnswer;
    }

    /**
     * @param string $trueAnswer
     */
    public function setTrueAnswer(string $trueAnswer): void
    {
        $this->trueAnswer = $trueAnswer;
    }


}