<?php

class WrittenResponses extends Model
{
    public static function selectAllWrittenResponsesQuestions(Array $A_parameters = null):?array {
        $P_db = Connection::initConnection();
        $S_stmnt = "SELECT s.id, s.module, s.description, s.question, w.true_answer FROM STORIES s INNER JOIN WRITTENRESPONSES w ON s.id = w.id";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->execute();
        $P_db = null;
        return $P_sth->fetchAll();
    }

    public static function createWrittenResponse(Array $A_parameters = null):array {
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
}