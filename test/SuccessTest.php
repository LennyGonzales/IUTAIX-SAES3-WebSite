<?php


use PHPUnit\Framework\TestCase;

include_once '../Core/AutoLoad.php';
class SuccessTest extends TestCase
{

    public function testGenericSuccess()
    {
        $this->assertEquals('Votre requête a été effectué avec succès.', Success::GENERIC_SUCCESS);
    }

    public function testLogin()
    {
        $this->assertEquals('Vous êtes connecté !', Success::LOGIN);
    }

    public function testSignUp()
    {
        $this->assertEquals('Votre compte a été créé, nous vous avons envoyé un mail de verification !', Success::SIGNUP);
        $this->assertEquals('Votre compte a été crée', Success::SIGNUP_AFTER_VERIFIED);
    }

    public function testPasswordVerification()
    {
        $this->assertEquals('Le mot de passe est valide.', Success::PASSWORD_VERIFICATION);
    }

    public function testEmailVerification()
    {
        $this->assertEquals('Le mail est valide', Success::EMAIL_VERIFICATION);
    }

    public function testQuestion()
    {
        $this->assertEquals('La question a été ajoutée !', Success::QUESTION_ADDED);
        $this->assertEquals('La question a été supprimée !', Success::QUESTION_DELETED);
        $this->assertEquals('La question a été modifiée !', Success::QUESTION_UPDATED);
        $this->assertEquals('La question existe', Success::QUESTION_EXISTS);
    }


}
