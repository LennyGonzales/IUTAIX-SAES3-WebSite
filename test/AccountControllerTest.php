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


    public function testConnectActionValidEmailPassword() {
        $A_postParams = array('email' => 'test.test@etu.univ-amu.fr', 'user_password' => 'Password12@');
        $controller = new AccountController( new Users(), new UsersNotVerified(), new RetrievePasswords(),new MultipleChoiceQuestions(),new WrittenResponseQuestions());
        $controller->connectAction(null, $A_postParams);
        $this->assertEquals(View::show("account/account", array("errorMessage" => true)), $content);
    }

    public function testSignUpRequestAction()
    {
        //Test if the $A_details is Success::SIGNUP
        $A_postParams = array('email' => 'test.test@etu.univ-amu.fr', 'user_password' => 'password', 'user_password_verification' => 'password');
        $controller = new AccountController( new Users(), new UsersNotVerified(), new RetrievePasswords(),new MultipleChoiceQuestions(),new WrittenResponseQuestions());
        $controller->signUpRequestAction(null, $A_postParams);
        $this->assertEquals(View::show("account/account", array("errorMessage" => true)), $content);

    }




    public function testVerifyMailAction()
    {
        $controller = new AccountController( new Users(), new UsersNotVerified(), new RetrievePasswords(),new MultipleChoiceQuestions(),new WrittenResponseQuestions());
        $controller->verifyMailAction();

        // Vérifier que la vue attendue est renvoyée
        $this->assertEquals(View::show("account/account", array("errorMessage" => true)), $content);
    }



}
