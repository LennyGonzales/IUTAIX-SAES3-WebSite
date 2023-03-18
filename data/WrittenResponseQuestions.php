<?php


class WrittenResponseQuestions extends Model implements QuestionsAccessInterface
{
    /**
     * Get a written response question with all the attributes excepts id
     * @param array|null $A_values all the attributes excepts id
     * @return MultipleChoiceQuestion|null an instance of WrittenResponseQuestion or null if the question doesn't exist
     */
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

    /**
     * Create a written response question
     * @param array|null $A_values all the attributes of the table
     * @return bool if the creation worked or not
     */
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

    /**
     * Update a written response question with all the attributes
     * @param array|null $A_values all the attributes of the table
     * @return bool if the update worked or not
     */
    public static function update(Array $A_values = null):bool {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "UPDATE WRITTENRESPONSEQUESTIONS SET MODULE = :module, DESCRIPTION = :description, QUESTION = :question, TRUE_ANSWER = :true_answer WHERE ID = :id";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':module', $A_values['module'], PDO::PARAM_STR);
        $P_sth->bindValue(':description', $A_values['description'], PDO::PARAM_STR);
        $P_sth->bindValue(':question', $A_values['question'], PDO::PARAM_STR);
        $P_sth->bindValue(':true_answer', $A_values['true_answer'], PDO::PARAM_INT);
        $P_sth->bindValue(':id', $A_values['id'], PDO::PARAM_INT);
        $B_state = $P_sth->execute();

        return $B_state;
    }
}