<?php


use PHPUnit\Framework\TestCase;

include_once '../Core/AutoLoad.php';

class UserTest extends TestCase
{

    public function testConstruct()
    {
        $user = new User('test.test@etu.univ-amu.fr', 'password12@P', 'active', 0);

        $this->assertEquals('test.test@etu.univ-amu.fr', $user->getEmail());
        $this->assertEquals('password12@P', $user->getPassword());
        $this->assertEquals('active', $user->getUserStatus());
        $this->assertEquals(0, $user->getPoints());
    }

    public function testGetEmail()
    {
        $user = new User('test.test@etu.univ-amu.fr', 'Password12@', 'user', 10);
        $this->assertEquals('test.test@etu.univ-amu.fr', $user->getEmail());
    }

    public function testSetEmail()
    {
        $user = new User('test.test@etu.univ-amu.fr', 'Password12@', 'user', 10);
        $user->setEmail('test2.test@etu.univ-amu.fr');
        $this->assertEquals('test2.test@etu.univ-amu.fr', $user->getEmail());
    }

    public function testGetPassword()
    {
        $user = new User('test2.test@etu.univ-amu.fr', 'Password12@', 'user', 10);
        $this->assertEquals('Password12@', $user->getPassword());
    }

    public function testSetPassword()
    {
        $user = new User('test2.test@etu.univ-amu.fr', 'Password12@', 'user', 10);
        $user->setPassword('Newpassword13!');
        $this->assertEquals('Newpassword13!', $user->getPassword());
    }

    public function testGetUserStatus()
    {
        $user = new User('test2.test@etu.univ-amu.fr', 'password12P@', 'user', 10);
        $this->assertEquals('user', $user->getUserStatus());
    }

    public function testSetUserStatus()
    {
        $user = new User('test2.test@etu.univ-amu.fr', 'password12P@', 'user', 10);
        $user->setUserStatus('admin');
        $this->assertEquals('admin', $user->getUserStatus());
    }

    public function testGetPoints()
    {
        $user = new User('test2.test@etu.univ-amu.fr', 'password12@P', 'user', 10);
        $this->assertEquals(10, $user->getPoints());
    }

    public function testSetPoints()
    {
        $user = new User('test2.test@etu.univ-amu.fr', 'password12P@', 'user', 10);
        $user->setPoints(50);
        $this->assertEquals(50, $user->getPoints());
    }

}
