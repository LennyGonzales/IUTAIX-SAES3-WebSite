<?php

final class AccountController extends DefaultController
{
    public function defaultAction(): void
    {
        View::show("account/account");
    }

    /**
     * Verify the array message received when the user sign-in or sign-up
     * @param array|null $A_details the array message
     * @return void
     */
    public function verificationMessage(array $A_details = null): void
    {
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

    /**
     * Supports the sign-in action
     * @param array|null $A_parametres null
     * @param array|null $A_postParams contains the user email and password
     * @return void
     */
    public function connectAction(array $A_parametres = null, array $A_postParams = null): void
    {
        $usersChecking = new UsersChecking();
        $A_details = $usersChecking->verifyAuthentication($A_postParams, $this->getUsersSqlAccess());

        $this->verificationMessage($A_details);
    }


    public function sendAction(array $A_parametres = null, array $A_postParams = null): void
    {
        $usersNotVerifiedChecking = new UsersNotVerifiedChecking();
        $A_postParams['token'] = rand(100000, 999999);      // Generate token
        $A_details = $usersNotVerifiedChecking->createAccount($A_postParams, $this->getUsersNotVerifiedSqlAccess(), $this->getUsersSqlAccess());

        if ($A_details['messageType'] == 'successful') {
            $usersNotVerifiedChecking->sendMailVerification($A_postParams);
            header('Location: /account/verifyMail');
            exit;
        }

        // If there is an error (email already exists, password not as strong as expected, ...)
        View::show("message", array(
            'messageType' => $A_details['messageType'],
            'message' => $A_details['message']
        ));
        View::show("account/account", array("errorMessage" => true));
    }

    public function verificationAction(array $A_parametres = null, array $A_postParams = null): void    // Put the link in the mail
    {
        $usersNotVerifiedChecking = new UsersNotVerifiedChecking();
        $A_user = $usersNotVerifiedChecking->getByEmail($A_postParams['email'], $this->getUsersNotVerifiedSqlAccess());

        // Verification token
        if ($A_user["token"] != $A_postParams["token"]) {
            $usersNotVerifiedChecking->deleteByEmail($A_postParams['email'], $this->getUsersNotVerifiedSqlAccess());
            header("Location: /account");
            exit;
        }

        // Verified
        $usersNotVerifiedChecking->deleteByEmail($A_postParams['email'], $this->getUsersNotVerifiedSqlAccess());
        $usersChecking = new UsersChecking();
        $A_details = $usersChecking->createAccount(array('email' => $A_user['email'], 'user_password' => $A_user['user_password']), $this->getUsersSqlAccess());

        $A_details['user_status'] = $usersChecking->getByEmail($A_user['email'], $this->getUsersSqlAccess())['user_status'];
        $this->verificationMessage($A_details);
    }

    public function verifyMailAction(array $A_parametres = null, array $A_postParams = null): void
    {
        View::show("Verify_mail/verifyMail", array("errorMessage" => true));
    }
}