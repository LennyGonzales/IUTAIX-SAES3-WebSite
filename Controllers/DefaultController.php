<?php

class DefaultController
{
    private UsersAccessInterface $usersSqlAccess;
    private QuestionsAccessInterface $multipleChoiceQuestionsSqlAccess;
    private QuestionsAccessInterface $writtenResponseQuestionsSqlAccess;
    private UsersNotVerifiedAccessInterface $usersNotVerifiedSqlAccess;
    private RetrievePasswordAccessInterface $retrievePasswordSqlAccess;

    public function __construct(UsersAccessInterface $usersSqlAccess, UsersNotVerifiedAccessInterface $usersNotVerifiedSqlAccess, RetrievePasswordAccessInterface  $retrievePasswordSqlAccess, QuestionsAccessInterface $multipleChoiceQuestionsSqlAccess, QuestionsAccessInterface $writtenResponseQuestionsSqlAccess)
    {
        $this->usersSqlAccess = $usersSqlAccess;
        $this->multipleChoiceQuestionsSqlAccess = $multipleChoiceQuestionsSqlAccess;
        $this->writtenResponseQuestionsSqlAccess = $writtenResponseQuestionsSqlAccess;
        $this->usersNotVerifiedSqlAccess = $usersNotVerifiedSqlAccess;
        $this->retrievePasswordSqlAccess = $retrievePasswordSqlAccess;
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

    /**
     * @return UsersNotVerifiedAccessInterface
     */
    public function getUsersNotVerifiedSqlAccess(): UsersNotVerifiedAccessInterface
    {
        return $this->usersNotVerifiedSqlAccess;
    }

    /**
     * @return RetrievePasswordAccessInterface
     */
    public function getRetrievePasswordSqlAccess(): RetrievePasswordAccessInterface
    {
        return $this->retrievePasswordSqlAccess;
    }
}