<?php

class QuestionsChecking
{
    /**
     * Verify if the question already exists and create the question
     * @param array|null $A_values contains the values to create the question
     * @param QuestionsAccessInterface $questionsSqlAccess reverse dependencies (ask an interface)
     * @return string[] Create specific messages that need to be returned to the user
     */
    public function createQuestion(Array $A_values = null, QuestionsAccessInterface $questionsSqlAccess):array {
        if($questionsSqlAccess->getQuestion($A_values) != null) {   // Verify if the question already exists
            return array('messageType' => 'error', 'message' => 'La question existe déjà !');
        }

        if($questionsSqlAccess->create($A_values)) { // The creation worked
            return array('messageType' => 'successful', 'message' => 'La question a été ajoutée !');
        }

        return array('messageType' => 'error', 'message' => 'L\'ajout d\'une question à échoué, veuillez réésayer.');
    }

    /**
     * Delete the question by its id
     * @param string|null $S_id the question id
     * @param QuestionsAccessInterface $questionsSqlAccess reverse dependencies (ask the interface)
     * @return string[] Create specific messages that need to be returned to the user
     */
    public function deleteQuestion(string $S_id =null, QuestionsAccessInterface $questionsSqlAccess):array {
        if($questionsSqlAccess->deleteById($questionsSqlAccess::DATABASE, $S_id)) {  // The deletion worked
            return array('messageType' => 'successful', 'message' => 'La question a été supprimée !');
        }

        return array('messageType' => 'error', 'message' => "La suppression de la question à échouée, veuillez réésayer.");
    }

    /**
     * Get a question by its id
     * @param string|null $S_id the question id
     * @param QuestionsAccessInterface $questionsSqlAccess reverse dependencies (ask the interface)
     * @return array with of the question parameters/attributes
     */
    public function getQuestion(string $S_id = null, QuestionsAccessInterface $questionsSqlAccess):array {
        return $questionsSqlAccess->getById($questionsSqlAccess::DATABASE, $S_id);
    }

    /**
     * Update a question
     * @param array|null $A_values all the attributes of the question (MultipleChoiceQuestions or WrittenResponseQuestions) table
     * @param QuestionsAccessInterface $questionsSqlAccess reverse dependencies (ask the interface)
     * @return string[]  Create specific messages that need to be returned to the user
     */
    public function updateQuestion(Array $A_values = null, QuestionsAccessInterface $questionsSqlAccess): array {
        if($questionsSqlAccess->getQuestion($A_values) != null) {   // Verify if the question already exists
            return array('messageType' => 'error', 'message' => 'La question n\'existe pas !');
        }

        if($questionsSqlAccess->update($A_values)) {  // The creation worked
            return array('messageType' => 'successful', 'message' => 'La question a été modifiée !');
        }

        return array('messageType' => 'error', 'message' => 'La modification de la question à échouée, veuillez réésayer.');
    }
}