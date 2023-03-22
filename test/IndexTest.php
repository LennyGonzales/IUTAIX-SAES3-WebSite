<?php


use PHPUnit\Framework\TestCase;

include_once '../Core/AutoLoad.php';
class IndexTest extends TestCase
{
    public function testController()
    {
        $_GET['url'] = 'test';
        $_POST = array('test' => 'test');
        $multipleChoiceQuestionsSqlAccess = new MultipleChoiceQuestions();
        $writtenResponseQuestionsSqlAccess = new WrittenResponseQuestions();
        $usersSqlAccess = new Users();
        $usersNotVerifiedSqlAccess = new UsersNotVerified();
        $retrievePasswordSqlAccess = new RetrievePasswords();

        $O_controller = new Controller($_GET['url'],$_POST,$usersSqlAccess,$usersNotVerifiedSqlAccess,$retrievePasswordSqlAccess,$multipleChoiceQuestionsSqlAccess,$writtenResponseQuestionsSqlAccess);
        $this->assertEquals('test',$_GET['url']);
        $this->assertEquals(array('test' => 'test'),$_POST);
    }

}
