<?php


use PHPUnit\Framework\TestCase;

include_once 'Core/AutoLoad.php';

class RetrievePasswordsTest extends TestCase
{

    public function testCreate()
    {


        $data = [
            'email' => 'test.test@etu.univ-amu.fr',
            'token' => '12345678'
        ];

        $this->retrievePasswords = new RetrievePasswords();

        $this->assertTrue($this->retrievePasswords->create($data));
    }

    public function testGetByEmail()
    {
        $data =  [ 'email' => 'mohammed.kaddouri@etu.univ-amu.fr',
            'token' => '667333'
        ];

        $this->retrievePasswords = new RetrievePasswords();

        $this->retrievePasswords->create($data);

        $retrievePassword = $this->retrievePasswords->getByEmail('mohammed.kaddouri@etu.univ-amu.fr');

        $this->assertInstanceOf(Retrievepassword::class, $retrievePassword);
        $this->assertEquals('mohammed.kaddouri@etu.univ-amu.fr', $retrievePassword->getEmail());
        $this->assertEquals('667333', $retrievePassword->getToken());

    }

    public function testUpdate()
    {

        $data = [
            'email' => 'test.test@etu.univ-amu.fr',
            'token' => '87654321'
        ];

        $this->retrievePasswords = new RetrievePasswords();

        $this->assertTrue($this->retrievePasswords->update($data));
    }

    public function testDelete()
    {
        $data = 'mohammed.kaddouri@etu.univ-amu.fr';

        $this->retrievePasswords = new RetrievePasswords();


        $this->assertTrue($this->retrievePasswords->delete('mohammed.kaddouri@etu.univ-amu.fr'));
    }


}
