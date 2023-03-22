<?php


use PHPUnit\Framework\TestCase;

include_once '../Core/AutoLoad.php';

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

        $retrievePassword = $this->retrievePasswords->getByEmail('test.test@etu.univ-amu.fr');

        $this->assertInstanceOf(Retrievepassword::class, $retrievePassword);
        $this->assertEquals('test.test@etu.univ-amu.fr', $retrievePassword->getEmail());
        $this->assertEquals('12345678', $retrievePassword->getToken());

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
        $data = 'test.test@etu.univ-amu.fr';

        $this->retrievePasswords = new RetrievePasswords();


        $this->assertTrue($this->retrievePasswords->delete($data));
    }


}
