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
        if ($A_retrievePassword["token"] != $A_postParams["token"]){    // If the token entered isn't equals to the token in the database
            header("Location: /retrievepwd");
            exit;
        }

        $A_details = $retrievePasswordChecking->verifyPassword($A_postParams);
        if($A_details['messageType'] == 'successful') {
            $usersChecking = new UsersChecking();
            $usersChecking->updateAccount($A_postParams, $this->getUsersSqlAccess());

            $retrievePasswordChecking->deleteByEmail($A_postParams['email'], $this->getRetrievePasswordSqlAccess());

            header("Location: /account");
            exit;
        }

        // If there is an error (email already exists, password not as strong as expected, ...)
        View::show("message", array(
            'messageType' => $A_details['messageType'],
            'message' => $A_details['message']
        ));
        $this->defaultAction();
    }


}