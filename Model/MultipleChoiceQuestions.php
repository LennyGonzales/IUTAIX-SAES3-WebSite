<?php

class MultipleChoiceQuestions extends Model
{
    const DATABASE = "STORIES";

    public static function create(Array $A_values = null):array {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "INSERT INTO MULTIPLECHOICEQUESTIONS (MODULE, DESCRIPTION, QUESTION, TRUE_ANSWER, ANSWER_1, ANSWER_2, ANSWER_3) VALUES (:module, :description, :question, :true_answer, :answer_1, :answer_2, :answer_3)";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':module', $A_values['module'], PDO::PARAM_STR);
        $P_sth->bindValue(':description', $A_values['description'], PDO::PARAM_STR);
        $P_sth->bindValue(':question', $A_values['question'], PDO::PARAM_STR);
        $P_sth->bindValue(':true_answer', $A_values['true_answer'], PDO::PARAM_INT);
        $P_sth->bindValue(':answer_1', $A_values['answer_1'], PDO::PARAM_STR);
        $P_sth->bindValue(':answer_2', $A_values['answer_2'], PDO::PARAM_STR);
        $P_sth->bindValue(':answer_3', $A_values['answer_3'], PDO::PARAM_STR);
        $B_state = $P_sth->execute();

        if($B_state) {  // The creation worked
            return array(
                'messageType' => 'successful',
                'message' => 'La question a été ajouté !'
            );
        }

        return array(
            'messageType' => 'error',
            'message' => 'L\'ajout d\'une question à échoué, veuillez réésayer.'
        );
    }
}