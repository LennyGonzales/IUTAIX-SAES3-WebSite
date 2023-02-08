<?php

/**
 * Class RetrievepwddirectivesController
 *
 * This class provides methods to give the directives for retrieving password.
 */
class RetrievepwddirectivesController
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

        if(!Users::checkIfExistsByEmail($A_postParams['email'])) {
            header("Location: /home");
            exit;
        }

        $I_token = verification_tokens::generateToken();
        $A_postParams["token"] = $I_token;

        if (verification_tokens::checkIfExistsByPrimaryKey("token",$A_postParams["token"])){
            echo $A_postParams['token'];
            verification_tokens::updateByPrimaryKey($A_postParams,"token",$A_postParams["token"]);
        }
        else{
            verification_tokens::create($A_postParams);
        }

        verification_tokens::sendMail($A_postParams);
        header("Location: /retrievepwd");
        exit;
    }
}