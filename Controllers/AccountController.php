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

    /**
     * Verify the array message received when the user sign-in or sign-up
     * @param array|null $A_details the array message
     * @return void
     */
    public function verificationMessage(Array $A_details = null):void {
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

    /**
     * Supports the sign-in action
     * @param array|null $A_parametres null
     * @param array|null $A_postParams contains the user email and password
     * @return void
     */
    public function connectAction(Array $A_parametres = null, Array $A_postParams = null):void {
        $usersChecking = new UsersChecking();
        $A_details = $usersChecking->verifyAuthentication($A_postParams, $this->getUsersSqlAccess());

        $this->verificationMessage($A_details);
    }


    /**
     * Supports the sign-up action
     * @param array|null $A_parametres null
     * @param array|null $A_postParams contains the user email, password and verification password
     * @return void
     */
    public function createAction(Array $A_parametres = null, Array $A_postParams = null):void {
        $usersChecking = new UsersChecking();
        $A_details = $usersChecking->createAccount($A_postParams, $this->getUsersSqlAccess());

        $this->verificationMessage($A_details);
    }
}