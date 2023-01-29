<?php

final class AccountController
{
    public function defaultAction():void {
        View::show("account/account");
    }

    public function connectAction(Array $A_parametres = null, Array $A_postParams = null):void {
        $S_status = Users::selectStatus($A_postParams);
        if($S_status != null){
            Session::start($S_status);
            header('Location: /home');
            exit;
        }
        header('Location: /account');
    }
}