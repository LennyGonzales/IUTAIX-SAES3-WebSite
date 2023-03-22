<?php


use PHPUnit\Framework\TestCase;

include_once '../Core/AutoLoad.php';

class RetrievepwddirectivesControllerTest extends TestCase
{
    public function testDefaultAction()
    {
        $retrievepwddirectivesController = new RetrievepwddirectivesController(  new Users(), new UsersNotVerified(), new RetrievePasswords(),new MultipleChoiceQuestions(),new WrittenResponseQuestions());
        $retrievepwddirectivesController->defaultAction();
        $this->assertEquals(View::show("retrieve_pwd/form-directives"), $content);

    }

    public function testSendAction()
    {
        $retrievepwddirectivesController = new RetrievepwddirectivesController(  new Users(), new UsersNotVerified(), new RetrievePasswords(),new MultipleChoiceQuestions(),new WrittenResponseQuestions());
        $retrievepwddirectivesController->sendAction();
        $this->assertEquals(View::show("retrieve_pwd/form-directives"), $content);

    }

    private $RetrievepwddirectivesController;
    private $A_parametres;
    private $A_postParams;

    protected function setUp() : void
    {
        $this->RetrievepwddirectivesController = new RetrievepwddirectivesController( new Users(), new UsersNotVerified(), new RetrievePasswords(),new MultipleChoiceQuestions(),new WrittenResponseQuestions());
        $this->A_parametres = null;
        $this->A_postParams = [
            'email' => 'test@test.com',
            'token' => 'token'
        ];
    }

    public function testSendAction2()
    {
        $this->RetrievepwddirectivesController->sendAction($this->A_parametres, $this->A_postParams);
        $this->assertEquals($this->A_postParams['token'], 'token');
    }





}
