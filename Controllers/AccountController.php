<?php

final class AccountController extends DefaultController
{
    public function __construct(UsersAccessInterface $usersSqlAccess, QuestionsAccessInterface $multipleChoiceQuestionsSqlAccess, QuestionsAccessInterface $writtenResponseQuestionsSqlAccess)
    {
        parent::__construct($usersSqlAccess, $multipleChoiceQuestionsSqlAccess, $writtenResponseQuestionsSqlAccess);
    }


    public function defaultAction():void {
        View::show("account/account");
    }

    public function connectAction(Array $A_parametres = null, Array $A_postParams = null):void {
        $usersChecking = new UsersChecking();    // ???---
        $A_details = $usersChecking->verifyAuthentication($A_postParams, $this->getUsersSqlAccess());

        //$A_details = UsersChecking::verifyAuthentication($A_postParams);
        if($A_details['messageType'] == 'successful') { // If the user exists and the password in the DB is equal to the password entered
            Session::start($A_details['user_status']);
            header('Location: /home');
            exit;
        }

        View::show("message", array(
            'messageType' => $A_details['messageType'],
            'message' => $A_details['message']
        ));
        View::show("account/account", array("errorMessage" => true));
    }

    public function createAction(Array $A_parametres = null, Array $A_postParams = null):void {
        $A_details = UsersSqlAccess::createAccount($A_postParams);
        if($A_details['messageType'] == 'successful') {  // Verify if the creation worked
            Session::start(UsersSqlAccess::selectByEmail($A_postParams)['user_status']);
            header('Location: /home');
            exit;
        }

        View::show("message", array(
            'messageType' => $A_details['messageType'],
            'message' => $A_details['message']
        ));
        View::show("account/account", array("errorMessage" => true));
    }
}