<?php

final class AccountController extends DefaultController
{
    public function defaultAction(): void
    {
        View::show("account/account");
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

        if($A_details['message'] == Success::LOGIN) {
            Session::start($A_postParams['email'], $A_details['user_status']);  // Set the session
            header('Location: /home');
            exit;
        }
        View::show("message", array('messageType' => 'error', 'message' => $A_details['message']));
        View::show("account/account", array("errorMessage" => true));
    }


    /**
     * Supports the application sign up
     * @param array|null $A_parametres null
     * @param array|null $A_postParams contains the email, password and verification password
     * @return void
     */
    public function signUpRequestAction(array $A_parametres = null, array $A_postParams = null): void
    {
        $userChecking = new UsersChecking();

        $S_details = $userChecking->verifyMail($this->getUsersSqlAccess(), $A_postParams['email']);
        if($S_details == Success::EMAIL_VERIFICATION) { // Verification mail
            $S_details = $userChecking->verifyPassword($A_postParams['user_password'], $A_postParams['user_password_verification']);

            if($S_details == Success::PASSWORD_VERIFICATION) {  // Verification password
                $A_postParams['token'] = (new RandomTokenGenerator())->generate();      // Generate a random token
                $usersNotVerifiedChecking = new UsersNotVerifiedChecking();
                $usersNotVerifiedChecking->createAccount($A_postParams, $this->getUsersNotVerifiedSqlAccess());
                $usersNotVerifiedChecking->sendMailVerification($A_postParams);
                header('Location: /account/verifyMail');
                exit;
            }
        }
        // If there is an error (email already exists, password not as strong as expected, ...)
        View::show("message", array('messageType' => 'error', 'message' => $S_details));
        View::show("account/account", array("errorMessage" => true));
    }

    public function verificationAction(array $A_parametres = null, array $A_postParams = null): void    // Put the link in the mail
    {
        $usersNotVerifiedChecking = new UsersNotVerifiedChecking();
        $A_user = $usersNotVerifiedChecking->getByEmail($A_postParams['email'], $this->getUsersNotVerifiedSqlAccess());
        if($A_user != null) {
            View::show("message", array('messageType' => 'error', 'message' => Errors::EMAIL_NOT_EXISTS));
            View::show("account/account", array("errorMessage" => true));
        } else {
            $usersNotVerifiedChecking->deleteByEmail($A_postParams['email'], $this->getUsersNotVerifiedSqlAccess());
            // Verification token
            if ($A_user["token"] != $A_postParams["token"]) {
                header("Location: /account");
                exit;
            }

            // Verified
            $usersChecking = new UsersChecking();
            $A_details['message'] = $usersChecking->createAccount(array('email' => $A_user['email'], 'user_password' => $A_user['user_password']), $this->getUsersSqlAccess());
            $A_details['user_status'] = $usersChecking->getByEmail($A_user['email'], $this->getUsersSqlAccess())['user_status'];

            if ($A_details['message'] == Success::SIGNUP_AFTER_VERIFIED) { // If the user exists and the password in the DB is equal to the password entered
                Session::start($A_postParams['email'], $A_details['user_status']);
                header('Location: /home');
                exit;
            }

            View::show("message", array('messageType' => 'error', 'message' => $A_details['message']));
            View::show("account/account", array("errorMessage" => true));
        }
    }

    public function verifyMailAction(array $A_parametres = null, array $A_postParams = null): void
    {
        View::show("Verify_mail/verifyMail", array("errorMessage" => true));
    }
}