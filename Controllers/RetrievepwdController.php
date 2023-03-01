<?php


/**
 * Class RetrievepwdController
 *
 * This class contains the actions related to the user retrieving his password
 *
 * @package Controllers
 */
class RetrievepwdController
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
        $A_retrieveTable =  verification_tokens::selectByPrimaryKey('token',$A_postParams["token"]);
        $S_mail=Users::selectByEmail($A_postParams);

        if ($A_retrieveTable["token"] != $A_postParams["token"]){
            //Token doesnt exists
            header("Location: /retrievepwd");
            exit;
        }

        $expiration_date = strtotime($A_retrieveTable["expiration_date"]);
        if (time() > $expiration_date) {
            header("Location: /retrievepwd");
            exit;
        }




        if ($A_postParams["user_password"] != $A_postParams["password_confirmation"]){
            //Passwords do not match
            header("Location: /retrievepwd");
            exit;
        }
        $S_token= $A_postParams["token"];
        unset($A_postParams["password_confirmation"]);
        unset($A_postParams["token"]);

        $A_postParams['user_password'] = hash('sha512', $A_postParams['user_password']);
        $A_postParams['email'] = $S_mail['email'];

        Users::updateByPrimaryKey($A_postParams);

        verification_tokens::deleteByPrimaryKey('token',$S_token);

        header("Location: /account");
        exit;
    }


}