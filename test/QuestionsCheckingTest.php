<?php


use PHPUnit\Framework\TestCase;



include_once '../Core/AutoLoad.php';

class QuestionsCheckingTest extends TestCase
{
    public function testCreateQuestion()
    {
        $questionsAccess = $this->createMock(QuestionsAccessInterface::class);
        $questionsChecking = new QuestionsChecking();
        $A_values = ['id' => '1', 'type' => 'written'];

        $questionsAccess->expects($this->once())
            ->method('getQuestion')
            ->with($A_values)
            ->willReturn(null);

        $questionsAccess->expects($this->once())
            ->method('create')
            ->with($A_values)
            ->willReturn(true);

        $this->assertEquals(
            Success::QUESTION_ADDED,
            $questionsChecking->createQuestion($A_values, $questionsAccess)
        );
    }


    public function testUpdateQuestion()
    {
        $questionsAccess = $this->createMock(QuestionsAccessInterface::class);
        $questionsChecking = new QuestionsChecking();
        $A_values = ['id' => '1', 'type' => 'written'];

        $questionsAccess->expects($this->once())
            ->method('getQuestion')
            ->with($A_values)
            ->willReturn(null);

        $questionsAccess->expects($this->once())
            ->method('update')
            ->with($A_values)
            ->willReturn(true);

        $this->assertEquals(
            Success::QUESTION_UPDATED,
            $questionsChecking->updateQuestion($A_values, $questionsAccess)
        );
    }

    public function testGetAllQuestions()
    {
        $questionsAccess = $this->createMock(QuestionsAccessInterface::class);
        $questionsChecking = new QuestionsChecking();
        $A_questions = ['id' => '1', 'type' => 'written'];

        $questionsAccess->expects($this->once())
            ->method('getAll')
            ->willReturn($A_questions);

        $this->assertEquals(
            $A_questions,
            $questionsChecking->getAllQuestions($questionsAccess)
        );
    }



}
