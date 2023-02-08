<?php

final class AccountController
{
    public function defaultAction():void {
        View::show("account/account");
    }

    public function connectAction(Array $A_parametres = null, Array $A_postParams = null):void {
        $A_details = Users::verifyAuthentication($A_postParams);
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
        $A_details = Users::createAccount($A_postParams);

        if($A_details['messageType'] == 'successful') {  // Verify if the creation worked
            Session::start(Users::selectByEmail($A_postParams)['user_status']);
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