<?php

class DefaultController
{
    private UsersAccessInterface $usersSqlAccess;
    private QuestionsAccessInterface $multipleChoiceQuestionsSqlAccess;
    private QuestionsAccessInterface $writtenResponseQuestionsSqlAccess;

    public function __construct(UsersAccessInterface $usersSqlAccess, QuestionsAccessInterface $multipleChoiceQuestionsSqlAccess, QuestionsAccessInterface $writtenResponseQuestionsSqlAccess)
    {
        $this->usersSqlAccess = $usersSqlAccess;
        $this->multipleChoiceQuestionsSqlAccess = $multipleChoiceQuestionsSqlAccess;
        $this->writtenResponseQuestionsSqlAccess = $writtenResponseQuestionsSqlAccess;
    }

    /**
     * @return QuestionsAccessInterface
     */
    public function getMultipleChoiceQuestionsSqlAccess(): QuestionsAccessInterface
    {
        return $this->multipleChoiceQuestionsSqlAccess;
    }

    /**
     * @return QuestionsAccessInterface
     */
    public function getWrittenResponseQuestionsSqlAccess(): QuestionsAccessInterface
    {
        return $this->writtenResponseQuestionsSqlAccess;
    }

    /**
     * @return UsersAccessInterface
     */
    public function getUsersSqlAccess(): UsersAccessInterface
    {
        return $this->usersSqlAccess;
    }


}