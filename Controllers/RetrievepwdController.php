<?php


/**
 * Class RetrievepwdController
 *
 * This class contains the actions related to the user retrieving his password
 *
 * @package Controllers
 */
class RetrievepwdController extends DefaultController
{
    /**
     * This action displays the form to enter the new password
     *
     * @return void
     */
    public function defaultAction() : void{
        View::show("retrieve_pwd/form-change-pwd");
    }

    /**
     * This action updates the new password and redirects the user to the signin page
     *
     * @param Array $A_parametres [optional]
     * @param Array $A_postParams [required]
     *
     * @return void
     */
    public function updateAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        $retrievePasswordChecking = new RetrievePasswordChecking();
        $A_retrievePassword = $retrievePasswordChecking->getByEmail($A_postParams['email'], $this->getRetrievePasswordSqlAccess());

        if($A_retrievePassword == null) {   // If the email provides doesn't exist
            View::show("message", array('messageType' => 'error', 'message' => Errors::EMAIL_NOT_EXISTS));
        } else {
            $retrievePasswordChecking->deleteByEmail($A_postParams['email'], $this->getRetrievePasswordSqlAccess());

            if ($A_retrievePassword["token"] != $A_postParams["token"]) {    // If the token entered isn't equals to the token in the database
                header("Location: /retrievepwd");
                exit;
            }

            $usersChecking = new UsersChecking();
            $A_details = $usersChecking->verifyPassword($A_postParams['user_password'], $A_postParams['user_password_verification']);
            if ($A_details == Success::PASSWORD_VERIFICATION) {
                $usersChecking = new UsersChecking();
                $usersChecking->updateAccount($A_postParams, $this->getUsersSqlAccess());
                header("Location: /account");
                exit;
            }
            // If there is an error with the password
            View::show("message", array('messageType' => 'error', 'message' => $A_details));
        }

        $this->defaultAction();
    }


}