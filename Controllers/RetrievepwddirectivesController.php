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
            View::show("message", array('messageType' => 'error', 'message' => Errors::EMAIL_NOT_EXISTS));
            $this->defaultAction();
        } else {
            $A_postParams["token"]  = (new RandomTokenGenerator())->generate();        // Generates token
            $retrievePasswordChecking = new RetrievePasswordChecking();

            if(($retrievePasswordChecking->getByEmail($A_postParams['email'], $this->getRetrievePasswordSqlAccess()) != null)  // If the user have already sent a request
                && ($retrievePasswordChecking->update($A_postParams, $this->getRetrievePasswordSqlAccess()))) {    // We change the token stores in the database with the new token
                $retrievePasswordChecking->sendMail($A_postParams);
                header("Location: /retrievepwd");
                exit;
            }

            if($retrievePasswordChecking->create($A_postParams, $this->getRetrievePasswordSqlAccess())) {
                $retrievePasswordChecking->sendMail($A_postParams);
                header("Location: /retrievepwd");
                exit;
            }

            View::show("message", array('messageType' => 'error', 'message' => Errors::GENERIC_ERROR));
            $this->defaultAction();
        }
    }
}