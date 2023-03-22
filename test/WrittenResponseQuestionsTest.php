<?php


use PHPUnit\Framework\TestCase;

include_once 'Core/AutoLoad.php';

class WrittenResponseQuestionsTest extends TestCase
{

    public function testGetQuestion()
    {
        $A_values = array(
            'module' => 'Introduction aux réseaux',
            'description' => 'Quelques jours avant les examens, le professeur pose une question à Mohammed qui parlait avec son voisin.',
            'question' => 'La question est : "À la réception, les données remontent dans la pile TCP/IP et les entêtes de protocoles sont supprimés au fur et à mesure, c’est :"',
            'true_answer' => 'Désencapsulation'
        );
        $O_question = new WrittenResponseQuestions();
        $O_question=$O_question-> getQuestion($A_values);
        $this->assertEquals($O_question->getModule(), $A_values['module']);
        $this->assertEquals($O_question->getDescription(), $A_values['description']);
        $this->assertEquals($O_question->getQuestion(), $A_values['question']);
        $this->assertEquals($O_question->getTrueAnswer(), $A_values['true_answer']);
    }

    public function testCreate()
    {
        $A_values = array(
            'module' => 'test',
            'description' => 'test',
            'question' => 'test',
            'true_answer' => 'test'
        );
        $B_state = new WrittenResponseQuestions();
        $B_state=$B_state->create($A_values);
        $this->assertTrue($B_state);
    }

    public function testUpdate()
    {
        $A_values = array(
            'module' => 'test',
            'description' => 'test',
            'question' => 'test',
            'true_answer' => 'test'
        );
        $O_question = new WrittenResponseQuestions();
        $O_question=$O_question->getQuestion($A_values);
        $A_values['id'] = $O_question->getId();
        $A_values['module'] = 'test2';
        $A_values['description'] = 'test2';
        $A_values['question'] = 'test2';
        $A_values['true_answer'] = 'test2';
        $B_state = WrittenResponseQuestions::update($A_values);
        $this->assertTrue($B_state);
    }

}