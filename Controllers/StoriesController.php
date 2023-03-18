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

    public function defaultAction(array $A_message = null):void {
        self::verificationSession();

        if($A_message != null) {    // If there is a message, show it
            View::show("message", $A_message);
        }
        View::show("stories/multiplechoicequestions/empty-form");
        View::show("stories/writtenresponsequestions/empty-form");
        View::show("stories/multiplechoicequestions/showAll", MultipleChoiceQuestions::selectAll());
        View::show("stories/writtenresponsequestions/showAll", WrittenResponseQuestions::selectAll());

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
        $A_details = $questionChecking->createQuestion($A_postParams, $this->getMultipleChoiceQuestionsSqlAccess());

        self::defaultAction($A_details);
    }

    /**
     * Delete a multiple choice quesions
     * @param array|null $A_parametres contains the id of a multiple choice question
     * @param array|null $A_postParams null
     * @return void
     */
    public function deleteMultipleChoiceQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $S_id = $A_parametres[0];   // Get the id
        $questionChecking = new QuestionsChecking();
        $A_details = $questionChecking->deleteQuestion($S_id, $this->getMultipleChoiceQuestionsSqlAccess());

        self::defaultAction($A_details);
    }

    public function showUpdateFormMultipleChoiceQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $S_id = $A_parametres[0];
        View::show("stories/multiplechoicequestions/update-form", MultipleChoiceQuestions::select($S_id));
    }

    public function updateMultipleChoiceQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $A_status = MultipleChoiceQuestions::update($A_postParams);
        self::defaultAction($A_status);
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
        $A_details = $questionChecking->createQuestion($A_postParams, $this->getWrittenResponseQuestionsSqlAccess());

        self::defaultAction($A_details);
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
        $A_details = $questionChecking->deleteQuestion($S_id, $this->getWrittenResponseQuestionsSqlAccess());

        self::defaultAction($A_details);
    }

    public function showUpdateFormWrittenResponseQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $S_id = $A_parametres[0];
        View::show("stories/writtenresponsequestions/update-form", WrittenResponseQuestions::select($S_id));
    }

    public function updateWrittenResponseQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $A_status = WrittenResponseQuestions::update($A_postParams);
        self::defaultAction($A_status);
    }
}