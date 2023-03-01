<?php

final class AccountController
{
    public function defaultAction(): void
    {
        View::show("account/account");
    }

    public function connectAction(array $A_parametres = null, array $A_postParams = null): void
    {
        $A_details = Users::verifyAuthentication($A_postParams);
        if ($A_details['messageType'] == 'successful') { // If the user exists and the password in the DB is equal to the password entered
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


    public function sendAction(array $A_parametres = null, array $A_postParams = null): void
    {
        Users::createAccount($A_postParams);
        $I_token = verification_tokens::generateToken();
        $A_postParams["token"] = $I_token;
        var_dump($A_postParams);
        Users::createToken($A_postParams);
        Users::sendMailVerification($A_postParams);
        View::show("Verify_mail/verifyMail", array("errorMessage" => true));

    }


    public function createAction(array $A_parametres = null, array $A_postParams = null): void
    {
        var_dump($A_postParams);
        $A_retrieveTable = verification_tokens::selectByPrimaryKey('user_email', $A_postParams["email"]);
        var_dump($A_retrieveTable);

        if ($A_retrieveTable["token"] != $A_postParams["token"]) {
            //Token doesnt exists
            verification_tokens::deleteByPrimaryKey('user_email', $A_postParams["email"]);
            Users::deleteAccount($A_retrieveTable);
            echo "Token doesnt exists";
            //header("Location: /account");
            exit;
        }

        $expiration_date = strtotime($A_retrieveTable["expiration_date"]);
        if (time() > $expiration_date) {

            //Token expired
            verification_tokens::deleteByPrimaryKey('user_email', $A_postParams["email"]);
            Users::deleteAccount($A_retrieveTable);
            header("Location: /account");
            exit;
        }

        $S_token = $A_postParams["token"];
        var_dump($A_postParams);
        verification_tokens::deleteByPrimaryKey('token', $S_token);
        //header("Location: /account");

    }
}