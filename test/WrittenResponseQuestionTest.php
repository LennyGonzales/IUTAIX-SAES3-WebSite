<?php


use PHPUnit\Framework\TestCase;

require_once '../Core/AutoLoad.php';

class WrittenResponseQuestionTest extends TestCase
{

    public function testConstructor()
    {
        // Arrange
        $id = 0;
        $module = 'test';
        $description = 'test';
        $question = 'test?';
        $trueAnswer = 'test !';

        $question = new WrittenResponseQuestion($id, $module, $description, $question, $trueAnswer);

        $this->assertEquals($trueAnswer, $question->getTrueAnswer());
    }

    public function testSetTrueAnswer()
    {
        // Arrange
        $id = 0;
        $module = 'test';
        $description = 'test';
        $question = 'test?';
        $trueAnswer = 'test !';

        $question = new WrittenResponseQuestion($id, $module, $description, $question, $trueAnswer);

        $newTrueAnswer = 'test !';
        $question->setTrueAnswer($newTrueAnswer);

        $this->assertEquals($newTrueAnswer, $question->getTrueAnswer());
    }

    public function testGetTrueAnswer()
    {
        // Arrange
        $id = 0;
        $module = 'test';
        $description = 'test';
        $question = 'test?';
        $trueAnswer = 'test !';

        $question = new WrittenResponseQuestion($id, $module, $description, $question, $trueAnswer);

        $this->assertEquals($trueAnswer, $question->getTrueAnswer());
    }



}
