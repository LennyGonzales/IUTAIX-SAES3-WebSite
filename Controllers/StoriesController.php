<?php

final class StoriesController
{
    public function defaultAction(array $A_message = null):void {
        if (!Session::check()) {    // Check if the user is connected
            header('Location: /account');   // Redirect to the account page
            exit;
        }
        if (Session::getSession()['user_status'] == 'Student') {    // Check if the user is a Student
            header('Location: /home');  // Redirect to the home page
            exit;
        }

        if($A_message != null) {    // If there is a message, show it
            View::show("message", $A_message);
        }
        View::show("stories/writtenresponsequestions/empty-form");
        View::show("stories/multiplechoicequestions/empty-form");
        View::show("stories/writtenresponsequestions/show", WrittenResponses::selectAllWrittenResponsesQuestions());
        View::show("stories/multiplechoicequestions/show", MultipleChoiceResponses::selectAllMultipleChoiceResponsesQuestions());
    }

    public function deleteWrittenResponseQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        $S_id = $A_parametres[0];

        WrittenResponses::deleteByID($S_id);
        if(!MultipleChoiceResponses::checkIfExistsByPrimaryKey('ID', $S_id)) {  // If the story isn't link with a multiple choice response
            Stories::deleteByID($S_id); // Delete the story
        }

        self::defaultAction();
    }

    public function deleteMultipleChoiceResponsesQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        $S_id = $A_postParams['id'];
        MultipleChoiceResponses::deleteByID($S_id);
        if(!WrittenResponses::checkIfExistsByPrimaryKey('ID', $S_id)) {  // If the story isn't link with a written response
            Stories::deleteByID($S_id); // Delete the story
        }

        self::defaultAction();
    }

    public function insertStory(Array $A_parameters = null):?string {
        $A_row = array(
            'module' => $A_parameters['module'],
            'description' => $A_parameters['description'],
            'question' => $A_parameters['question']
        );

        $A_status = Stories::createStory($A_row);
        if($A_status['messageType'] == 'error') {    // Insert the module, description and question in the Stories table
            self::defaultAction($A_status);
            exit;
        }

        return Stories::selectId($A_row);  // Get the id of the story
    }

    public function insertWrittenResponseQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        var_dump($A_postParams);
        $S_id = self::insertStory($A_postParams);

        $A_row = array(     // Prepare the array
            'id' => $S_id,
            'true_answer' => $A_postParams['true_answer']
        );
        $A_status = WrittenResponses::createWrittenResponse($A_row);

        self::defaultAction($A_status);
    }

    public function insertMultipleChoiceQuestionAction(Array $A_parametres = null, Array $A_postParams = null):void {
        $S_id = self::insertStory($A_postParams);

        $A_row = array(     // Prepare the array
            'id' => $S_id,
            'true_answer' => $A_postParams['true_answer'],
            'answer_1' => $A_postParams['answer_1'],
            'answer_2' => $A_postParams['answer_2'],
            'answer_3' => $A_postParams['answer_3']
        );
        $A_status = MultipleChoiceResponses::createMultipleChoiceResponse($A_row);

        self::defaultAction($A_status);
    }
}