<?php

class QuestionsChecking
{
    /**
     * Verify if the question already exists and create the question
     * @param array|null $A_values contains the values to create the question
     * @param QuestionsAccessInterface $questionsSqlAccess reverse dependencies (ask an interface)
     * @return string Create specific messages that need to be returned to the user
     */
    public function createQuestion(Array $A_values = null, QuestionsAccessInterface $questionsSqlAccess):string {
        if($questionsSqlAccess->getQuestion($A_values) != null) {   // Verify if the question already exists
            return Errors::QUESTION_ALREADY_EXISTS;
        }

        if($questionsSqlAccess->create($A_values)) { // The creation worked
            return Success::QUESTION_ADDED;
        }

        return Errors::GENERIC_ERROR;
    }

    /**
     * Delete the question by its id
     * @param string|null $S_id the question id
     * @param QuestionsAccessInterface $questionsSqlAccess reverse dependencies (ask the interface)
     * @return string Create specific messages that need to be returned to the user
     */
    public function deleteQuestion(string $S_id =null, QuestionsAccessInterface $questionsSqlAccess):string {
        if(!$questionsSqlAccess->getById($questionsSqlAccess::DATABASE, $S_id)) {
            return Errors::QUESTION_NOT_EXISTS;
        }

        if($questionsSqlAccess->deleteById($questionsSqlAccess::DATABASE, $S_id)) {  // The deletion worked
            return Success::QUESTION_DELETED;
        }

        return Errors::GENERIC_ERROR;
    }

    /**
     * Get a question by its id
     * @param string|null $S_id the question id
     * @param QuestionsAccessInterface $questionsSqlAccess reverse dependencies (ask the interface)
     * @return array|null with of the question parameters/attributes
     */
    public function getQuestion(string $S_id = null, QuestionsAccessInterface $questionsSqlAccess):?array {
        $A_question = $questionsSqlAccess->getById($questionsSqlAccess::DATABASE, $S_id);
        if($A_question != null) {
            return array('question' => $A_question, 'message' => Success::QUESTION_EXISTS);
        }
        return array('message' => Errors::QUESTION_NOT_EXISTS);
    }

    /**
     * Update a question
     * @param array|null $A_values all the attributes of the question (MultipleChoiceQuestions or WrittenResponseQuestions) table
     * @param QuestionsAccessInterface $questionsSqlAccess reverse dependencies (ask the interface)
     * @return string Create specific messages that need to be returned to the user
     */
    public function updateQuestion(Array $A_values = null, QuestionsAccessInterface $questionsSqlAccess): string {
        if($questionsSqlAccess->getQuestion($A_values) != null) {   // Verify if the question already exists
            return Errors::QUESTION_NOT_EXISTS;
        }

        if($questionsSqlAccess->update($A_values)) {  // The creation worked
            return Success::QUESTION_UPDATED;
        }

        return Errors::GENERIC_ERROR;
    }

    /**
     * Get all the questions
     * @param QuestionsAccessInterface $questionsSqlAccess reverse dependencies (ask the interface)
     * @return array contains all the tuples of the table
     */
    public function getAllQuestions(QuestionsAccessInterface $questionsSqlAccess):array {
        return $questionsSqlAccess->getAll();
    }
}