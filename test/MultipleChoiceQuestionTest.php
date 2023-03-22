<?php


use PHPUnit\Framework\TestCase;

include_once 'Core/AutoLoad.php';

class MultipleChoiceQuestionTest extends TestCase
{

    public function testConstructor()
    {
        $multipleChoiceQuestion = new MultipleChoiceQuestion(1, 'My Module', 'My Description', 'My Question', 1, 'Answer 1', 'Answer 2', 'Answer 3');

        $this->assertEquals(1, $multipleChoiceQuestion->getId());
        $this->assertEquals('My Module', $multipleChoiceQuestion->getModule());
        $this->assertEquals('My Description', $multipleChoiceQuestion->getDescription());
        $this->assertEquals('My Question', $multipleChoiceQuestion->getQuestion());
        $this->assertEquals(1, $multipleChoiceQuestion->getTrueAnswer());
        $this->assertEquals('Answer 1', $multipleChoiceQuestion->getAnswer1());
        $this->assertEquals('Answer 2', $multipleChoiceQuestion->getAnswer2());
        $this->assertEquals('Answer 3', $multipleChoiceQuestion->getAnswer3());
    }

    private $multipleChoiceQuestion;

    protected function setUp(): void
    {
        $this->multipleChoiceQuestion = new MultipleChoiceQuestion(1, 'Module 1', 'Description', 'Question', 1, 'a1', 'a2', 'a3');
    }

    public function testGetTrueAnswer()
    {
        $this->assertEquals($this->multipleChoiceQuestion->getTrueAnswer(), 1);
    }

    public function testSetTrueAnswer()
    {
        $this->multipleChoiceQuestion->setTrueAnswer(2);
        $this->assertEquals($this->multipleChoiceQuestion->getTrueAnswer(), 2);
    }

    public function testGetAnswer1()
    {
        $this->assertEquals($this->multipleChoiceQuestion->getAnswer1(), 'a1');
    }

    public function testSetAnswer1()
    {
        $this->multipleChoiceQuestion->setAnswer1('b1');
        $this->assertEquals($this->multipleChoiceQuestion->getAnswer1(), 'b1');
    }

    public function testGetAnswer2()
    {
        $this->assertEquals($this->multipleChoiceQuestion->getAnswer2(), 'a2');
    }

    public function testSetAnswer2()
    {
        $this->multipleChoiceQuestion->setAnswer2('b2');
        $this->assertEquals($this->multipleChoiceQuestion->getAnswer2(), 'b2');
    }

    public function testGetAnswer3()
    {
        $this->assertEquals($this->multipleChoiceQuestion->getAnswer3(), 'a3');
    }

    public function testSetAnswer3()
    {
        $this->multipleChoiceQuestion->setAnswer3('b3');
        $this->assertEquals($this->multipleChoiceQuestion->getAnswer3(), 'b3');
    }




}
