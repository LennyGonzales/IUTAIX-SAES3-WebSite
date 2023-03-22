<?php


use PHPUnit\Framework\TestCase;

include_once '../Core/AutoLoad.php';

class MultipleChoiceQuestionsTest extends TestCase
{
    public function testGetQuestion() {
        $A_values = array(
            'module' => 'Ethernet',
            'description' => 'Des câbles se situe sur le dos de notre robot et il aimerait en savoir davantage sur lui.',
            'question' => 'Donnez lui les trois types de câbles dans Ethernet.',
            'true_answer' => '1',
            'answer_1' => 'Câble coaxial, Câble à paires torsadées, Fibre optique',
            'answer_2' => 'Câble coaxial, Câble à triples torsades, Fibre optique',
            'answer_3' => 'Câble biaxial, Câble à triples torsades, Fibre optique'
        );


        $O_question = new MultipleChoiceQuestions();
        $O_question= $O_question-> getQuestion($A_values);
        $this->assertEquals($A_values['module'], $O_question->getModule());
        $this->assertEquals($A_values['description'], $O_question->getDescription());
        $this->assertEquals($A_values['question'], $O_question->getQuestion());
        $this->assertEquals($A_values['true_answer'], $O_question->getTrueAnswer());
        $this->assertEquals($A_values['answer_1'], $O_question->getAnswer1());
        $this->assertEquals($A_values['answer_2'], $O_question->getAnswer2());
        $this->assertEquals($A_values['answer_3'], $O_question->getAnswer3());
    }


    public function testCreate() {
        $A_values = array(
            'module' => 'PHP TEST',
            'description' => 'Test',
            'question' => 'Test ?',
            'true_answer' => '2',
            'answer_1' => 'getTest',
            'answer_2' => 'getQuestion',
            'answer_3' => 'testQuestion'
        );



        $B_state = new MultipleChoiceQuestions();
        $B_state=$B_state->create($A_values);
        $this->assertTrue($B_state);
    }


    public function testUpdate() {
        $A_values = array(
            'module' => 'PHP TEST',
            'description' => 'Test',
            'question' => 'Test ?',
            'true_answer' => '2',
            'answer_1' => 'getTest',
            'answer_2' => 'getQuestion',
            'answer_3' => 'testQuestion'
        );

        $O_question =new MultipleChoiceQuestions();
        $O_question=$O_question->getQuestion($A_values);
        $A_values['id'] = $O_question->getId();
        $A_values['module'] = 'PHP TEST 2';
        $A_values['description'] = 'Test 2';
        $A_values['question'] = 'Test 2 ?';
        $A_values['true_answer'] = '2';
        $A_values['answer_1'] = 'getTest 2';
        $A_values['answer_2'] = 'getQuestion 2';
        $A_values['answer_3'] = 'testQuestion 2';
        $B_state= MultipleChoiceQuestions::update($A_values);
        $this->assertTrue($B_state);
    }





}

