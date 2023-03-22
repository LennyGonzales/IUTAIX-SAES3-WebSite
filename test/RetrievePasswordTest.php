<?php


use PHPUnit\Framework\TestCase;

include_once '../Core/AutoLoad.php';

class RetrievePasswordTest extends TestCase
{
    public function testConstructor()
    {
        $email = 'test.test@etu.univ-amu.fr';
        $token = 12345;
        $expiration_date = '2023-01-01';

        $retrieve_password = new RetrievePassword($email, $token, $expiration_date);

        $this->assertEquals($email, $retrieve_password->getEmail());
        $this->assertEquals($token, $retrieve_password->getToken());
        $this->assertEquals($expiration_date, $retrieve_password->getExpirationDate());
    }

    public function testSetEmail()
    {
        $email = 'test.test@etu.univ-amu.fr';
        $token = 12345;
        $expiration_date = '2023-01-01';

        $password = new RetrievePassword($email, $token, $expiration_date);
        $password->setEmail('test.test@etu.univ-amu.fr');
        $this->assertEquals('test.test@etu.univ-amu.fr', $password->getEmail());
    }

    public function testSetToken()
    {
        $email = 'test.test@etu.univ-amu.fr';
        $token = 12345;
        $expiration_date = '2023-01-01';

        $password = new RetrievePassword($email, $token, $expiration_date);
        $password->setToken(67890);
        $this->assertEquals(67890, $password->getToken());
    }

    public function testSetExpirationDate()
    {
        $email = 'test.test@etu.univ-amu.fr';
        $token = 12345;
        $expiration_date = '2023-01-01';

        $password = new RetrievePassword($email, $token, $expiration_date);
        $password->setExpirationDate('2021-01-01');
        $this->assertEquals('2021-01-01', $password->getExpirationDate());
    }

    public function testGetEmail()
    {
        $email = 'test.test@etu.univ-amu.fr';
        $token = 12345;
        $expiration_date = '2023-01-01';

        $retrieve_password = new RetrievePassword($email, $token, $expiration_date);
        $this->assertEquals($email, $retrieve_password->getEmail());


    }

    public function testGetToken()
    {
        $email = 'test.test@etu.univ-amu.fr';
        $token = 12345;
        $expiration_date = '2023-01-01';

        $retrieve_password = new RetrievePassword($email, $token, $expiration_date);

        $this->assertEquals($token, $retrieve_password->getToken());
    }

    public function testGetExpirationDate()
    {
        $email = 'test.test@etu.univ-amu.fr';
        $token = 12345;
        $expiration_date = '2023-01-01';

        $retrieve_password = new RetrievePassword($email, $token, $expiration_date);

        $this->assertEquals($expiration_date, $retrieve_password->getExpirationDate());

    }







}
