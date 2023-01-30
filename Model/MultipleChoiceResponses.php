<?php

class MultipleChoiceResponses extends Model
{
    public static function selectAllMultipleChoiceResponsesQuestions(Array $A_parameters = null):?array {
        $P_db = Connection::initConnection();
        $S_stmnt = "SELECT s.id, s.module, s.description, s.question, m.true_answer, m.answer_1, m.answer_2, m.answer_3 FROM STORIES s INNER JOIN MULTIPLECHOICERESPONSES m ON s.id = m.id";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->execute();
        $P_db = null;
        return $P_sth->fetchAll();
    }

    public static function createMultipleChoiceResponse(Array $A_parameters = null):array {
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