<?php


use PHPUnit\Framework\TestCase;

include_once '../Core/AutoLoad.php';


class QuestionTest extends TestCase
{

    public function testConstructor()
    {
        $question = new Question(1, 'module', 'description', 'question');
        $this->assertEquals(1, $question->getId());
        $this->assertEquals('module', $question->getModule());
        $this->assertEquals('description', $question->getDescription());
        $this->assertEquals('question', $question->getQuestion());
    }

    public function testSetId()
    {
        $question = new Question(1, 'module', 'description', 'question');
        $question->setId(2);
        $this->assertEquals(2, $question->getId());
    }

    public function testSetModule()
    {
        $question = new Question(1, 'module', 'description', 'question');
        $question->setModule('module2');
        $this->assertEquals('module2', $question->getModule());
    }

    public function testSetDescription()
    {
        $question = new Question(1, 'module', 'description', 'question');
        $question->setDescription('description2');
        $this->assertEquals('description2', $question->getDescription());
    }

    public function testSetQuestion()
    {
        $question = new Question(1, 'module', 'description', 'question');
        $question->setQuestion('question2');
        $this->assertEquals('question2', $question->getQuestion());
    }

    public function testGetId()
    {
        $question = new Question(1, 'module', 'description', 'question');
        $this->assertEquals(1, $question->getId());
    }

    public function testGetModule()
    {
        $question = new Question(1, 'module', 'description', 'question');
        $this->assertEquals('module', $question->getModule());
    }

    public function testGetDescription()
    {
        $question = new Question(1, 'module', 'description', 'question');
        $this->assertEquals('description', $question->getDescription());
    }

    public function testGetQuestion()
    {
        $question = new Question(1, 'module', 'description', 'question');
        $this->assertEquals('question', $question->getQuestion());
    }



}
