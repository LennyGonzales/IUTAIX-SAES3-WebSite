<?php

class MultipleChoiceQuestions extends Model implements QuestionsAccessInterface
{
    /**
     * Get a multiple choice question with all the attributes excepts id
     * @param array|null $A_values all the attributes excepts id
     * @return MultipleChoiceQuestion|null an instance of MultipleChoiceQuestion or null if the question doesn't exist
     */
    public static function getQuestion(Array $A_values = null):?MultipleChoiceQuestion {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT * FROM MULTIPLECHOICEQUESTIONS WHERE MODULE = :module AND DESCRIPTION = :description AND QUESTION = :question AND TRUE_ANSWER = :true_answer AND ANSWER_1 = :answer_1 AND ANSWER_2 = :answer_2 AND ANSWER_3 = :answer_3";
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

        if($A_result != null) {
            return new MultipleChoiceQuestion($A_result['id'], $A_result['module'], $A_result['description'], $A_result['question'], $A_result['true_answer'], $A_result['answer_1'], $A_result['answer_2'], $A_result['answer_3']);
        }
        return null;
    }

    /**
     * Create a multiple choice question
     * @param array|null $A_values all the attributes of the table
     * @return bool if the creation worked or not
     */
    public static function create(Array $A_values = null):bool {
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

        return $B_state;
    }

    /**
     * Update a multiple choice question with all the attributes
     * @param array|null $A_values all the attributes of the table
     * @return bool if the update worked or not
     */
    public static function update(Array $A_values = null):bool {
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

        return $B_state;
    }
}