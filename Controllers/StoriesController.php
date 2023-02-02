<?php

final class StoriesController
{
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

    public function insertMultipleChoiceQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $A_status = MultipleChoiceQuestions::create($A_postParams);
        self::defaultAction($A_status);
    }

    public function deleteMultipleChoiceQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $S_id = $A_parametres[0];
        $A_status = MultipleChoiceQuestions::delete($S_id);
        self::defaultAction($A_status);
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

    public function insertWrittenResponseQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $A_status = WrittenResponseQuestions::create($A_postParams);
        self::defaultAction($A_status);
    }

    public function deleteWrittenResponseQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        self::verificationSession();

        $S_id = $A_parametres[0];
        $A_status = WrittenResponseQuestions::delete($S_id);
        self::defaultAction($A_status);
    }
}