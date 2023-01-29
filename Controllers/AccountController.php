<?php

final class AccountController
{
    public function defaultAction():void {
        View::show("account/account");
    }

    public function connectAction(Array $A_parametres = null, Array $A_postParams = null):void {
        $A_row = Users::selectByUserEmail($A_postParams['email']);
        if(($A_row != null) && ($A_row['user_password'] == hash('sha512', $A_postParams['user_password']))) {   // If the user exists and the password in the DB is equal to the password entered
            Session::start($A_row['user_status']);
            header('Location: /home');
            exit;
        }
        View::show("account/account", array("errorMessage" => true));
    }

    public function createAction(Array $A_parametres = null, Array $A_postParams = null):void {
        $A_postParams['user_password'] = hash('sha512', $A_postParams['user_password']);
        if(Users::create($A_postParams)) {
            $S_status = Users::selectStatus($A_postParams);
            if($S_status != null) {
                Session::start($S_status);
                header('Location: /home');
                exit;
            }
            header('Location: /account');
        }
    }
}