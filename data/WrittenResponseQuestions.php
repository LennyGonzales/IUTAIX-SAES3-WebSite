<?php


class WrittenResponseQuestions extends Model implements QuestionsAccessInterface
{
    public static function getQuestion(Array $A_values = null):?WrittenResponseQuestion {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT * FROM WRITTENRESPONSEQUESTIONS WHERE MODULE = :module AND DESCRIPTION = :description AND QUESTION = :question AND TRUE_ANSWER = :true_answer";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':module', $A_values['module'], PDO::PARAM_STR);
        $P_sth->bindValue(':description', $A_values['description'], PDO::PARAM_STR);
        $P_sth->bindValue(':question', $A_values['question'], PDO::PARAM_STR);
        $P_sth->bindValue(':true_answer', $A_values['true_answer'], PDO::PARAM_STR);
        $P_sth->execute();
        $A_result = $P_sth->fetch();

        if($A_result != null) {
            return new WrittenResponseQuestion($A_result['id'], $A_result['module'], $A_result['description'], $A_result['question'], $A_result['true_answer']);
        }
        return null;
    }

    public static function select(string $S_id = null): array {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT * FROM WRITTENRESPONSEQUESTIONS WHERE ID = :id";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':id', $S_id, PDO::PARAM_STR);
        $P_sth->execute();
        return $P_sth->fetch();
    }


    public static function create(Array $A_values = null):bool
    {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "INSERT INTO WRITTENRESPONSEQUESTIONS (MODULE, DESCRIPTION, QUESTION, TRUE_ANSWER) VALUES (:module, :description, :question, :true_answer)";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':module', $A_values['module'], PDO::PARAM_STR);
        $P_sth->bindValue(':description', $A_values['description'], PDO::PARAM_STR);
        $P_sth->bindValue(':question', $A_values['question'], PDO::PARAM_STR);
        $P_sth->bindValue(':true_answer', $A_values['true_answer'], PDO::PARAM_STR);
        $B_state = $P_sth->execute();

        return $B_state;
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
        if(!WrittenResponseQuestions::checkIfExistsById($A_values['id'])) {
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