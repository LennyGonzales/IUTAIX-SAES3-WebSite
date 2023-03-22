<?php


use PHPUnit\Framework\TestCase;

include_once '../Core/AutoLoad.php';


class DefaultControllerTest extends TestCase
{

    public function testConstructor()
    {
        $usersSqlAccessMock = $this->createMock(UsersAccessInterface::class);
        $multipleChoiceQuestionsSqlAccessMock = $this->createMock(QuestionsAccessInterface::class);
        $writtenResponseQuestionsSqlAccessMock = $this->createMock(QuestionsAccessInterface::class);
        $usersNotVerifiedSqlAccessMock = $this->createMock(UsersNotVerifiedAccessInterface::class);
        $retrievePasswordSqlAccessMock = $this->createMock(RetrievePasswordAccessInterface::class);
        $defaultController = new DefaultController(
            $usersSqlAccessMock,
            $usersNotVerifiedSqlAccessMock,
            $retrievePasswordSqlAccessMock,
            $multipleChoiceQuestionsSqlAccessMock,
            $writtenResponseQuestionsSqlAccessMock
        );

        $this->assertEquals($usersSqlAccessMock, $defaultController->getUsersSqlAccess());
        $this->assertEquals($multipleChoiceQuestionsSqlAccessMock, $defaultController->getMultipleChoiceQuestionsSqlAccess());
        $this->assertEquals($writtenResponseQuestionsSqlAccessMock, $defaultController->getWrittenResponseQuestionsSqlAccess());
        $this->assertEquals($usersNotVerifiedSqlAccessMock, $defaultController->getUsersNotVerifiedSqlAccess());
        $this->assertEquals($retrievePasswordSqlAccessMock, $defaultController->getRetrievePasswordSqlAccess());
    }


    public function testgetmultiplechoicequestionssqlaccess()
    {
        $usersSqlAccessMock = $this->createMock(UsersAccessInterface::class);
        $multipleChoiceQuestionsSqlAccessMock = $this->createMock(QuestionsAccessInterface::class);
        $writtenResponseQuestionsSqlAccessMock = $this->createMock(QuestionsAccessInterface::class);
        $usersNotVerifiedSqlAccessMock = $this->createMock(UsersNotVerifiedAccessInterface::class);
        $retrievePasswordSqlAccessMock = $this->createMock(RetrievePasswordAccessInterface::class);
        $defaultController = new DefaultController(
            $usersSqlAccessMock,
            $usersNotVerifiedSqlAccessMock,
            $retrievePasswordSqlAccessMock,
            $multipleChoiceQuestionsSqlAccessMock,
            $writtenResponseQuestionsSqlAccessMock
        );

        $this->assertEquals($multipleChoiceQuestionsSqlAccessMock, $defaultController->getMultipleChoiceQuestionsSqlAccess());
    }

    public function testgetwrittenresponsequestionssqlaccess()
    {
        $usersSqlAccessMock = $this->createMock(UsersAccessInterface::class);
        $multipleChoiceQuestionsSqlAccessMock = $this->createMock(QuestionsAccessInterface::class);
        $writtenResponseQuestionsSqlAccessMock = $this->createMock(QuestionsAccessInterface::class);
        $usersNotVerifiedSqlAccessMock = $this->createMock(UsersNotVerifiedAccessInterface::class);
        $retrievePasswordSqlAccessMock = $this->createMock(RetrievePasswordAccessInterface::class);
        $defaultController = new DefaultController(
            $usersSqlAccessMock,
            $usersNotVerifiedSqlAccessMock,
            $retrievePasswordSqlAccessMock,
            $multipleChoiceQuestionsSqlAccessMock,
            $writtenResponseQuestionsSqlAccessMock
        );

        $this->assertEquals($writtenResponseQuestionsSqlAccessMock, $defaultController->getWrittenResponseQuestionsSqlAccess());
    }

    public function testgetuserssqlaccess()
    {
        $usersSqlAccessMock = $this->createMock(UsersAccessInterface::class);
        $multipleChoiceQuestionsSqlAccessMock = $this->createMock(QuestionsAccessInterface::class);
        $writtenResponseQuestionsSqlAccessMock = $this->createMock(QuestionsAccessInterface::class);
        $usersNotVerifiedSqlAccessMock = $this->createMock(UsersNotVerifiedAccessInterface::class);
        $retrievePasswordSqlAccessMock = $this->createMock(RetrievePasswordAccessInterface::class);
        $defaultController = new DefaultController(
            $usersSqlAccessMock,
            $usersNotVerifiedSqlAccessMock,
            $retrievePasswordSqlAccessMock,
            $multipleChoiceQuestionsSqlAccessMock,
            $writtenResponseQuestionsSqlAccessMock
        );

        $this->assertEquals($usersSqlAccessMock, $defaultController->getUsersSqlAccess());
    }

    public function testgetusersnotverifiedsqlaccess()
    {
        $usersSqlAccessMock = $this->createMock(UsersAccessInterface::class);
        $multipleChoiceQuestionsSqlAccessMock = $this->createMock(QuestionsAccessInterface::class);
        $writtenResponseQuestionsSqlAccessMock = $this->createMock(QuestionsAccessInterface::class);
        $usersNotVerifiedSqlAccessMock = $this->createMock(UsersNotVerifiedAccessInterface::class);
        $retrievePasswordSqlAccessMock = $this->createMock(RetrievePasswordAccessInterface::class);
        $defaultController = new DefaultController(
            $usersSqlAccessMock,
            $usersNotVerifiedSqlAccessMock,
            $retrievePasswordSqlAccessMock,
            $multipleChoiceQuestionsSqlAccessMock,
            $writtenResponseQuestionsSqlAccessMock
        );

        $this->assertEquals($usersNotVerifiedSqlAccessMock, $defaultController->getUsersNotVerifiedSqlAccess());
    }

    public function testgetretrievepasswordsqlaccess()
    {
        $usersSqlAccessMock = $this->createMock(UsersAccessInterface::class);
        $multipleChoiceQuestionsSqlAccessMock = $this->createMock(QuestionsAccessInterface::class);
        $writtenResponseQuestionsSqlAccessMock = $this->createMock(QuestionsAccessInterface::class);
        $usersNotVerifiedSqlAccessMock = $this->createMock(UsersNotVerifiedAccessInterface::class);
        $retrievePasswordSqlAccessMock = $this->createMock(RetrievePasswordAccessInterface::class);
        $defaultController = new DefaultController(
            $usersSqlAccessMock,
            $usersNotVerifiedSqlAccessMock,
            $retrievePasswordSqlAccessMock,
            $multipleChoiceQuestionsSqlAccessMock,
            $writtenResponseQuestionsSqlAccessMock
        );

        $this->assertEquals($retrievePasswordSqlAccessMock, $defaultController->getRetrievePasswordSqlAccess());
    }












}
