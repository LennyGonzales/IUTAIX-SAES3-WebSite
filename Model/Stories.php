<?php

class Stories extends Model
{
    public static function createStory(Array $A_parameters = null):array {
        if(!self::create($A_parameters)) {
            return array(
                'messageType' => 'error',
                'message' => 'L\'ajout d\'une question à échoué, veuillez réésayer.'
            );
        }
        return array(
            'messageType' => 'successful',
            'message' => 'La question a été ajouté !'
        );
    }

    public static function selectId(Array $A_parameters = null) {
        $P_db = Connection::initConnection();
        $S_stmnt = "SELECT ID FROM STORIES WHERE MODULE = :module AND DESCRIPTION = :description AND QUESTION = :question";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':module', $A_parameters['module'], PDO::PARAM_STR);
        $P_sth->bindValue(':description', $A_parameters['description'], PDO::PARAM_STR);
        $P_sth->bindValue(':question', $A_parameters['question'], PDO::PARAM_STR);
        $P_sth->execute();
        $S_id = $P_sth->fetch(PDO::FETCH_ASSOC)['id'];
        $P_db = null;
        return $S_id;
    }
}