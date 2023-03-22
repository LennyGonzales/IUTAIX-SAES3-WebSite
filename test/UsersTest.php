<?php


use PHPUnit\Framework\TestCase;

include_once 'Core/AutoLoad.php';
class UsersTest extends TestCase
{

    public function testCreate()
    {
        $A_values = [
            'email' => 'test.test@etu.univ-amu.fr',
            'user_password' => hash('sha512', 'testPassword12@')
        ];

        $users = new Users();
        $this->assertTrue($users->create($A_values));
    }

    public function testGetByEmail()
    {
        $S_email = 'mohammed.kaddouri@etu.univ-amu.fr';
        $users = new Users();
        $user = $users->getByEmail($S_email);
        $this->assertNotNull($user);
        $this->assertEquals('mohammed.kaddouri@etu.univ-amu.fr', $user->getEmail());
    }

    public function testGetByEmailAndPassword()
    {
        $email = 'lenny.gonzales@etu.univ-amu.fr';
        $password = hash('sha512', 'jn1ae(iuaez&éIU123;');
        $users = new Users();
        $user = $users->getByEmailAndPassword($email, $password);
        $this->assertNotNull($user);
        $this->assertEquals('lenny.gonzales@etu.univ-amu.fr', $user->getEmail());
    }

    public function testUpdate()
    {
        $A_values = [
            'email' => 'mohammed.kaddouri@etu.univ-amu.fr',
            'user_password' => hash('sha512', 'Mohammedpassword12@')
        ];
        $users = new Users();
        $this->assertTrue($users->update($A_values));
    }






}
