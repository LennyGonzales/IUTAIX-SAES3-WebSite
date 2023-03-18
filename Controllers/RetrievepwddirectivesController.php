<?php

/**
 * Class RetrievepwddirectivesController
 *
 * This class provides methods to give the directives for retrieving password.
 */
class RetrievepwddirectivesController extends DefaultController
{
    /**
     * Show view for password retrieval
     *
     * @return void
     */
    public function defaultAction() : void{
        View::show("retrieve_pwd/form-directives");
    }

    /**
     * Send password retrieval details and e-mail
     *
     * @param Array $A_parametres [optional]
     * @param Array $A_postParams [optional]
     *
     * @return void
     */
    public function sendAction(Array $A_parametres = null, Array $A_postParams = null) : void{

        $usersChecking = new UsersChecking();

        if($usersChecking->getByEmail($A_postParams['email'], $this->getUsersSqlAccess()) == null) {    // The user doesn't exists
            header("Location: /home");
            exit;
        }

        $A_postParams["token"]  = rand(100000, 999999);        // Generates token
        $retrievePasswordChecking = new RetrievePasswordChecking();
        if($retrievePasswordChecking->getByEmail($A_postParams['email'], $this->getRetrievePasswordSqlAccess()) != null) {
            $retrievePasswordChecking->update($A_postParams, $this->getRetrievePasswordSqlAccess());
            header("Location: /retrievepwd");
            exit;
        }

        if($retrievePasswordChecking->create($A_postParams, $this->getRetrievePasswordSqlAccess())) {
            $retrievePasswordChecking->sendMail($A_postParams);
            header("Location: /retrievepwd");
            exit;
        }
        // to do
    }
}