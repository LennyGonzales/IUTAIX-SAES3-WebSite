<?php

class WrittenResponseQuestionsSqlAccess extends Model implements QuestionsAccessInterface
{
    public static function checkIfExists(Array $A_values = null):bool {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT COUNT(*) FROM WRITTENRESPONSEQUESTIONS WHERE MODULE = :module AND DESCRIPTION = :description AND QUESTION = :question AND TRUE_ANSWER = :true_answer";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':module', $A_values['module'], PDO::PARAM_STR);
        $P_sth->bindValue(':description', $A_values['description'], PDO::PARAM_STR);
        $P_sth->bindValue(':question', $A_values['question'], PDO::PARAM_STR);
        $P_sth->bindValue(':true_answer', $A_values['true_answer'], PDO::PARAM_STR);
        $P_sth->execute();
        $A_result = $P_sth->fetch();
        return ($A_result['count'] > 0);
    }

    public static function select(string $S_id = null): array {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT * FROM WRITTENRESPONSEQUESTIONS WHERE ID = :id";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':id', $S_id, PDO::PARAM_STR);
        $P_sth->execute();
        return $P_sth->fetch();
    }


    public static function create(Array $A_values = null):array
    {
        if(WrittenResponseQuestionsSqlAccess::checkIfExists($A_values)) {
            return array(
                'messageType' => 'error',
                'message' => 'La question existe déjà !'
            );
        }

        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "INSERT INTO WRITTENRESPONSEQUESTIONS (MODULE, DESCRIPTION, QUESTION, TRUE_ANSWER) VALUES (:module, :description, :question, :true_answer)";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':module', $A_values['module'], PDO::PARAM_STR);
        $P_sth->bindValue(':description', $A_values['description'], PDO::PARAM_STR);
        $P_sth->bindValue(':question', $A_values['question'], PDO::PARAM_STR);
        $P_sth->bindValue(':true_answer', $A_values['true_answer'], PDO::PARAM_STR);
        $B_state = $P_sth->execute();

        if ($B_state) {  // The creation worked
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


    public static function delete(string $S_id = null):array {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "DELETE FROM WRITTENRESPONSEQUESTIONS WHERE ID = :id";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':id', $S_id, PDO::PARAM_INT);
        $B_state = $P_sth->execute();

        if($B_state) {  // The creation worked
            return array(
                'messageType' => 'successful',
                'message' => 'La question a été supprimé !'
            );
        }

        return array(
            'messageType' => 'error',
            'message' => "La suppression de la question à échoué, veuillez réésayer."
        );
    }

    public static function checkIfExistsById(string $S_id = null):bool {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT COUNT(*) FROM WRITTENRESPONSEQUESTIONS WHERE ID = :id";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':id', $S_id, PDO::PARAM_INT);
        $P_sth->execute();
        $A_result = $P_sth->fetch();
        return ($A_result['count'] > 0);
    }

    public static function update(Array $A_values = null):array {
        if(!WrittenResponseQuestionsSqlAccess::checkIfExistsById($A_values['id'])) {
            return array(
                'messageType' => 'error',
                'message' => 'La question n\'existe pas !'
            );
        }

        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "UPDATE WRITTENRESPONSEQUESTIONS SET MODULE = :module, DESCRIPTION = :description, QUESTION = :question, TRUE_ANSWER = :true_answer WHERE ID = :id";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':module', $A_values['module'], PDO::PARAM_STR);
        $P_sth->bindValue(':description', $A_values['description'], PDO::PARAM_STR);
        $P_sth->bindValue(':question', $A_values['question'], PDO::PARAM_STR);
        $P_sth->bindValue(':true_answer', $A_values['true_answer'], PDO::PARAM_INT);
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