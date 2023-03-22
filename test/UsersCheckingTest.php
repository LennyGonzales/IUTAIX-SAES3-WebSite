<?php


use PHPUnit\Framework\TestCase;

include_once '../Core/AutoLoad.php';

class UsersCheckingTest extends TestCase
{

    public function testVerifyAuthentication()
    {
        $A_parameters = array('email' => 'example@univ-amu.fr', 'user_password' => 'test');
        $usersSqlAccess = $this->getMockBuilder(UsersAccessInterface::class)
            ->onlyMethods(['create', 'getByEmail', 'update', 'getByEmailAndPassword'])
            ->getMock();
        $usersSqlAccess->expects($this->once())
            ->method('getByEmailAndPassword')
            ->will($this->returnValue(new User('example@univ-amu.fr', hash('sha512', 'test'), 'active', 0)));

        $usersChecking = new UsersChecking();
        $this->assertEquals(array('user_status' => 'active', 'message' => 'Vous êtes connecté !'), $usersChecking->verifyAuthentication($A_parameters, $usersSqlAccess));
    }

    public function testCreateAccount()
    {
        $A_values = array('email' => 'example@univ-amu.fr', 'user_password' => 'test');
        $usersSqlAccess = $this->getMockBuilder(UsersAccessInterface::class)
            ->onlyMethods(['create', 'getByEmail', 'update', 'getByEmailAndPassword'])
            ->getMock();
        $usersSqlAccess->expects($this->once())
            ->method('create')
            ->will($this->returnValue(true));

        $usersChecking = new UsersChecking();
        $this->assertEquals('Votre compte a été crée', $usersChecking->createAccount($A_values, $usersSqlAccess));
    }

    public function testGetByEmail()
    {
        $S_email = 'example@univ-amu.fr';
        $usersSqlAccess = $this->getMockBuilder(UsersAccessInterface::class)
            ->onlyMethods(['create', 'getByEmail', 'update', 'getByEmailAndPassword'])
            ->getMock();
        $usersSqlAccess->expects($this->once())
            ->method('getByEmail')
            ->will($this->returnValue(new User('example@univ-amu.fr', hash('sha512', 'test'), 'active', 0)));

        $usersChecking = new UsersChecking();
        $this->assertEquals(array('email' => 'example@univ-amu.fr', 'user_password' => hash('sha512', 'test'), 'user_status' => 'active', 'points' => 0), $usersChecking->getByEmail($S_email, $usersSqlAccess));
    }

    /**
     * Test the method updateAccount
     */
    public function testUpdateAccount()
    {
        $A_values = array('email' => 'example@univ-amu.fr', 'user_password' => 'test');
        $usersSqlAccess = $this->getMockBuilder(UsersAccessInterface::class)
            ->onlyMethods(['create', 'getByEmail', 'update', 'getByEmailAndPassword'])
            ->getMock();
        $usersSqlAccess->expects($this->once())
            ->method('update')
            ->will($this->returnValue(true));

        $usersChecking = new UsersChecking();
        $this->assertTrue($usersChecking->updateAccount($A_values, $usersSqlAccess));
    }

    /**
     * Test the method verifyPassword
     */
    public function testVerifyPassword()
    {
        $S_password = 'Password@1234';
        $S_verification_password = 'Password@1234';

        $usersChecking = new UsersChecking();
        $this->assertEquals('Le mot de passe est valide.', $usersChecking->verifyPassword($S_password, $S_verification_password));
    }

    /**
     * Test the method verifyMail
     */
    public function testVerifyMail()
    {
        $S_email = 'example@etu.univ-amu.fr';
        $usersSqlAccess = $this->getMockBuilder(UsersAccessInterface::class)
            ->onlyMethods(['create', 'getByEmail', 'update', 'getByEmailAndPassword'])
            ->getMock();
        $usersSqlAccess->expects($this->once())
            ->method('getByEmail')
            ->will($this->returnValue(null));

        $usersChecking = new UsersChecking();
        $this->assertEquals('Le mail est valide', $usersChecking->verifyMail($usersSqlAccess , $S_email));
    }








}
