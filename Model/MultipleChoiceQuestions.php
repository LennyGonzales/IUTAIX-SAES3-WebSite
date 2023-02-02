<?php

class MultipleChoiceQuestions extends Model
{
    const DATABASE = "STORIES";

    public static function checkIfExists(Array $A_values = null):bool {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT COUNT(*) FROM MULTIPLECHOICEQUESTIONS WHERE MODULE = :module AND DESCRIPTION = :description AND QUESTION = :question AND TRUE_ANSWER = :true_answer AND ANSWER_1 = :answer_1 AND ANSWER_2 = :answer_2 AND ANSWER_3 = :answer_3";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':module', $A_values['module'], PDO::PARAM_STR);
        $P_sth->bindValue(':description', $A_values['description'], PDO::PARAM_STR);
        $P_sth->bindValue(':question', $A_values['question'], PDO::PARAM_STR);
        $P_sth->bindValue(':true_answer', $A_values['true_answer'], PDO::PARAM_INT);
        $P_sth->bindValue(':answer_1', $A_values['answer_1'], PDO::PARAM_STR);
        $P_sth->bindValue(':answer_2', $A_values['answer_2'], PDO::PARAM_STR);
        $P_sth->bindValue(':answer_3', $A_values['answer_3'], PDO::PARAM_STR);
        $P_sth->execute();
        $A_result = $P_sth->fetch();
        return ($A_result['count'] > 0);
    }

    public static function select(string $S_id = null): array {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT * FROM MULTIPLECHOICEQUESTIONS WHERE ID = :id";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':id', $S_id, PDO::PARAM_STR);
        $P_sth->execute();
        return $P_sth->fetch();
    }

    public static function create(Array $A_values = null):array {
        if(MultipleChoiceQuestions::checkIfExists($A_values)) {
            return array(
                'messageType' => 'error',
                'message' => 'La question existe déjà !'
            );
        }

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
                'message' => 'La question a été ajoutée !'
            );
        }

        return array(
            'messageType' => 'error',
            'message' => 'L\'ajout d\'une question à échoué, veuillez réésayer.'
        );
    }

    public static function delete(string $S_id = null):array {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "DELETE FROM MULTIPLECHOICEQUESTIONS WHERE ID = :id";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':id', $S_id, PDO::PARAM_INT);
        $B_state = $P_sth->execute();

        if($B_state) {  // The creation worked
            return array(
                'messageType' => 'successful',
                'message' => 'La question a été supprimée !'
            );
        }

        return array(
            'messageType' => 'error',
            'message' => "La suppression de la question à échouée, veuillez réésayer."
        );
    }

    public static function checkIfExistsById(string $S_id = null):bool {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT COUNT(*) FROM MULTIPLECHOICEQUESTIONS WHERE ID = :id";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':id', $S_id, PDO::PARAM_INT);
        $P_sth->execute();
        $A_result = $P_sth->fetch();
        return ($A_result['count'] > 0);
    }

    public static function update(Array $A_values = null):array {
        if(!MultipleChoiceQuestions::checkIfExistsById($A_values['id'])) {
            return array(
                'messageType' => 'error',
                'message' => 'La question n\'existe pas !'
            );
        }

        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "UPDATE MULTIPLECHOICEQUESTIONS SET MODULE = :module, DESCRIPTION = :description, QUESTION = :question, TRUE_ANSWER = :true_answer, ANSWER_1 = :answer_1, ANSWER_2 = :answer_2, ANSWER_3 = :answer_3 WHERE ID = :id";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':module', $A_values['module'], PDO::PARAM_STR);
        $P_sth->bindValue(':description', $A_values['description'], PDO::PARAM_STR);
        $P_sth->bindValue(':question', $A_values['question'], PDO::PARAM_STR);
        $P_sth->bindValue(':true_answer', $A_values['true_answer'], PDO::PARAM_INT);
        $P_sth->bindValue(':answer_1', $A_values['answer_1'], PDO::PARAM_STR);
        $P_sth->bindValue(':answer_2', $A_values['answer_2'], PDO::PARAM_STR);
        $P_sth->bindValue(':answer_3', $A_values['answer_3'], PDO::PARAM_STR);
        $P_sth->bindValue(':id', $A_values['id'], PDO::PARAM_INT);
        $B_state = $P_sth->execute();

        if($B_state) {  // The creation worked
            return array(
                'messageType' => 'successful',
                'message' => 'La question a été modifiée !'
            );
        }

        return array(
            'messageType' => 'error',
            'message' => 'La modification de la question à échouée, veuillez réésayer.'
        );
    }
}