<?php

final class StoriesController extends DefaultController
{

    /**
     * Verify if the user is allows to see the page
     * @return void
     */
    public function verificationSession() {
        if (!Session::check()) {    // Check if the user is connected
            header('Location: /account');   // Redirect to the account page
            exit;
        }
        if (Session::getSession()['user_status'] == 'Student') {    // Check if the user is a Student
            header('Location: /home');  // Redirect to the home page
            exit;
        }
    }

    public function defaultAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $questionChecking = new QuestionsChecking();
        View::show("stories/multiplechoicequestions/empty-form");
        View::show("stories/writtenresponsequestions/empty-form");
        View::show("stories/multiplechoicequestions/showAll", $questionChecking->getAllQuestions($this->getMultipleChoiceQuestionsSqlAccess()));
        View::show("stories/writtenresponsequestions/showAll", $questionChecking->getAllQuestions($this->getWrittenResponseQuestionsSqlAccess()));
    }

    /**
     * Insert a multiple choice questions
     * @param array|null $A_parametres null
     * @param array|null $A_postParams contains all the information to create a multiple choice questions
     * @return void
     */
    public function insertMultipleChoiceQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $questionChecking = new QuestionsChecking();
        $E_state = $questionChecking->createQuestion($A_postParams, $this->getMultipleChoiceQuestionsSqlAccess());

        View::show("message", array('messageType' => (($E_state == Success::QUESTION_ADDED) ? 'successful' : 'error'), 'message' => $E_state));
        self::defaultAction();
    }

    /**
     * Delete a multiple choice questions
     * @param array|null $A_parametres contains the id of a multiple choice question
     * @param array|null $A_postParams null
     * @return void
     */
    public function deleteMultipleChoiceQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $S_id = $A_parametres[0];   // Get the id
        $questionChecking = new QuestionsChecking();
        $E_state = $questionChecking->deleteQuestion($S_id, $this->getMultipleChoiceQuestionsSqlAccess());

        View::show("message", array('messageType' => (($E_state == Success::QUESTION_DELETED) ? 'successful' : 'error'), 'message' => $E_state));
        self::defaultAction();
    }

    /**
     * Show update form for a multiple choice ques(ions
     * @param array|null $A_parametres contains the id of a multiple choice ques(ions
     * @param array|null $A_postParams null
     * @return void
     */
    public function showUpdateFormMultipleChoiceQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();
        $S_id = $A_parametres[0];

        $questionChecking = new QuestionsChecking();
        $A_details = $questionChecking->getQuestion($S_id, $this->getMultipleChoiceQuestionsSqlAccess());
        if($A_details['message'] == Success::QUESTION_EXISTS) {
            View::show("stories/multiplechoicequestions/update-form", $A_details['question']);
        } else {
            View::show("message", array('messageType' => 'error', 'message' => $A_details['message']));
            self::defaultAction();
        }
    }

    /**
     * Update a multiple choice question
     * @param array|null $A_parametres null
     * @param array|null $A_postParams contains all the information to update a multiple choice question
     * @return void
     */
    public function updateMultipleChoiceQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $questionChecking = new QuestionsChecking();
        $E_state = $questionChecking->updateQuestion($A_postParams, $this->getMultipleChoiceQuestionsSqlAccess());

        View::show("message", array('messageType' => (($E_state == Success::QUESTION_UPDATED) ? 'successful' : 'error'), 'message' => $E_state));
        self::defaultAction();
    }

    /**
     * Insert a written response question
     * @param array|null $A_parametres null
     * @param array|null $A_postParams contains all the information to create a written response question
     * @return void
     */
    public function insertWrittenResponseQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $questionChecking = new QuestionsChecking();
        $E_state = $questionChecking->createQuestion($A_postParams, $this->getWrittenResponseQuestionsSqlAccess());

        View::show("message", array('messageType' => (($E_state == Success::QUESTION_ADDED) ? 'successful' : 'error'), 'message' => $E_state));
        self::defaultAction();
    }

    /**
     * Delete a written response question
     * @param array|null $A_parametres contains the id of a written response question
     * @param array|null $A_postParams null
     * @return void
     */
    public function deleteWrittenResponseQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $S_id = $A_parametres[0];   // Get the id
        $questionChecking = new QuestionsChecking();
        $E_state = $questionChecking->deleteQuestion($S_id, $this->getWrittenResponseQuestionsSqlAccess());

        View::show("message", array('messageType' => (($E_state == Success::QUESTION_DELETED) ? 'successful' : 'error'), 'message' => $E_state));
        self::defaultAction();
    }

    /**
     * Show update form for a written response question
     * @param array|null $A_parametres contains the id of a written response question
     * @param array|null $A_postParams null
     * @return void
     */
    public function showUpdateFormWrittenResponseQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $S_id = $A_parametres[0];
        $questionChecking = new QuestionsChecking();
        $A_details = $questionChecking->getQuestion($S_id, $this->getWrittenResponseQuestionsSqlAccess());
        if($A_details['message'] == Success::QUESTION_EXISTS) {
            View::show("stories/writtenresponsequestions/update-form", $A_details['question']);
        } else {
            View::show("message", array('messageType' => 'error', 'message' => $A_details['message']));
            self::defaultAction();
        }
    }

    /**
     * Update a written response question
     * @param array|null $A_parametres null
     * @param array|null $A_postParams contains all the information to update a written response question
     * @return void
     */
    public function updateWrittenResponseQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $questionChecking = new QuestionsChecking();
        $E_state = $questionChecking->updateQuestion($A_postParams, $this->getWrittenResponseQuestionsSqlAccess());

        View::show("message", array('messageType' => (($E_state == Success::QUESTION_UPDATED) ? 'successful' : 'error'), 'message' => $E_state));
        self::defaultAction();
    }
}