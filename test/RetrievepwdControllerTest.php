<?php


use PHPUnit\Framework\TestCase;

include_once 'Core/AutoLoad.php';
class RetrievepwdControllerTest extends TestCase
{
    /**
     * Test if the defaultAction method returns the expected view
     */
    public function testDefaultAction()
    {
        $controller = new RetrievepwdController(new Users(), new UsersNotVerified(), new RetrievePasswords(),new MultipleChoiceQuestions(),new WrittenResponseQuestions());
        $this->assertEquals(View::show('retrieve_pwd/form-change-pwd'), $controller->defaultAction());
    }

    /**
     * Test if the updateAction method returns the expected view when successful
     */

    public function testUpdateAction(): void
    {
        $controller = new RetrievepwdController( new Users(), new UsersNotVerified(), new RetrievePasswords(),new MultipleChoiceQuestions(),new WrittenResponseQuestions());



    }




}
