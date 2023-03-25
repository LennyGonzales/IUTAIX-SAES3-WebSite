<?php

class Question
{
    private int $id;
    public string $module;
    public string $description;
    public string $question;
    private int $nbAnswers;
    private int $nbCorrectAnswers;

    /**
     * @param int $id
     * @param string $module
     * @param string $description
     * @param string $question
     */
    public function __construct(int $id, string $module, string $description, string $question)
    {
        $this->id = $id;
        $this->module = $module;
        $this->description = $description;
        $this->question = $question;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getModule(): string
    {
        return $this->module;
    }

    /**
     * @param string $module
     */
    public function setModule(string $module): void
    {
        $this->module = $module;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    /**
     * @return int
     */
    public function getNbAnswers(): int
    {
        return $this->nbAnswers;
    }

    /**
     * @param int $nbAnswers
     */
    public function setNbAnswers(int $nbAnswers): void
    {
        $this->nbAnswers = $nbAnswers;
    }

    /**
     * @return int
     */
    public function getNbCorrectAnswers(): int
    {
        return $this->nbCorrectAnswers;
    }

    /**
     * @param int $nbCorrectAnswers
     */
    public function setNbCorrectAnswers(int $nbCorrectAnswers): void
    {
        $this->nbCorrectAnswers = $nbCorrectAnswers;
    }
}