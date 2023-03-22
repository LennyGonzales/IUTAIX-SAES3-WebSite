<?php


use PHPUnit\Framework\TestCase;


include_once '../Core/AutoLoad.php';

class AccountControllerTest extends TestCase
{

    public function testDefaultAction(): void
    {
        // Crée une instance de AccountController

        $controller = new AccountController(new Users(), new UsersNotVerified(), new RetrievePasswords(),new MultipleChoiceQuestions(),new WrittenResponseQuestions());

        // Obtenir le contenu de la vue retourné par la méthode defaultAction
        $content = $controller->defaultAction();

        // Vérifier que le contenu de la vue est égal à "account/account"
        $this->assertEquals(View::show("account/account"), $content);
    }

    public function testVerificationMessage(): void
    {
        // Crée une instance de AccountController

        $controller = new AccountController(new Users(), new UsersNotVerified(), new RetrievePasswords(),new MultipleChoiceQuestions(),new WrittenResponseQuestions());

        // Obtenir le contenu de la vue retourné par la méthode defaultAction
        $content = $controller->verificationMessage();

        // Vérifier que le contenu de la vue est égal à "account/account"
        $this->assertEquals(View::show("account/account"), $content);
    }

    public function testVerificationMessage2(): void
    {

        $controller = new AccountController(new Users(), new UsersNotVerified(), new RetrievePasswords(),new MultipleChoiceQuestions(),new WrittenResponseQuestions());

        $content = $controller->verificationMessage();

        $this->assertEquals(View::show("message", array(
            'messageType' => $A_details['messageType'],
            'message' => $A_details['message']
        )), $content);
    }

    public function testVerificationMessage3(): void
    {

        $controller = new AccountController(new Users(), new UsersNotVerified(), new RetrievePasswords(),new MultipleChoiceQuestions(),new WrittenResponseQuestions());

        $content = $controller->verificationMessage();

        $this->assertEquals(View::show("account/account", array("errorMessage" => true)), $content);
    }

    public function testSendAction()
    {
        $controller = new AccountController(new Users(), new UsersNotVerified(), new RetrievePasswords(),new MultipleChoiceQuestions(),new WrittenResponseQuestions());
        $A_parametres = array();
        $A_postParams = array();
        $controller->sendAction($A_parametres, $A_postParams);
        $this->assertTrue(true);
    }













}
