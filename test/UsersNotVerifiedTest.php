<?php


use PHPUnit\Framework\TestCase;

include_once 'Core/AutoLoad.php';
class UsersNotVerifiedTest extends TestCase
{

    public function testCreate()
    {
        $A_values = array(
            "email" => "test.test2@etu.univ-amu.fr",
            "user_password" => hash('sha512',"testpassword@12"),
            "token" => "1234"
        );
        $B_state = new UsersNotVerified();
        $this->assertTrue($B_state->create($A_values));
    }

    public function testGetByEmail()
    {
        $S_email = "test.test2@etu.univ-amu.fr";
        $O_userNotVerified = new UsersNotVerified();
        $O_userNotVerified= $O_userNotVerified->getByEmail($S_email);
        $this->assertEquals("test.test2@etu.univ-amu.fr", $O_userNotVerified->getEmail());
    }

    public function testDeleteByEmail()
    {

        $B_state = "test.test2@etu.univ-amu.fr";
        $O_userNotVerified = new UsersNotVerified();
        $B_state = $O_userNotVerified->deleteByEmail($B_state);
        $this->assertTrue($B_state);
    }

}
