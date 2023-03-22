<?php


use PHPUnit\Framework\TestCase;

include_once '../Core/AutoLoad.php';

class UserNotVerifiedTest extends TestCase
{

    public function testConstructor()
    {
        $user = new UserNotVerified('test.test@etu.univ-amu.fr', 'Test_password12@', 1234, '2023-04-03');

        $this->assertEquals('test.test@etu.univ-amu.fr', $user->getEmail());
        $this->assertEquals('Test_password12@', $user->getUserPassword());
        $this->assertEquals(1234, $user->getToken());
        $this->assertEquals('2023-04-03', $user->getExpirationDate());
    }

    public function testGetEmail()
    {
        $userNotVerified = new UserNotVerified('test.test@etu.univ-amu.fr', 'Test_password12@', 12345, '2023-01-01');

        $this->assertEquals('test.test@etu.univ-amu.fr', $userNotVerified->getEmail());
    }

    /** @test */
    public function testGetUserPassword()
    {
        $userNotVerified = new UserNotVerified('test.test@etu.univ-amu.fr', 'Test_password12@', 12345, '2023-01-01');

        $this->assertEquals('Test_password12@', $userNotVerified->getUserPassword());
    }

    /** @test */
    public function testGetToken()
    {
        $userNotVerified = new UserNotVerified('test.test@etu.univ-amu.fr', 'Test_password12@', 12345, '2023-01-01');

        $this->assertEquals(12345, $userNotVerified->getToken());
    }

    /** @test */
    public function testGetExpirationDate()
    {
        $userNotVerified = new UserNotVerified('test.test@etu.univ-amu.fr', 'Test_password12@', 12345, '2023-01-01');

        $this->assertEquals('2023-01-01', $userNotVerified->getExpirationDate());
    }





}
