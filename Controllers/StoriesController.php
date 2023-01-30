<?php

final class StoriesController
{
    public function defaultAction(array $A_message = null):void {
        if($A_message != null) {
            View::show("message", $A_message);
        }
        View::show("stories/writtenresponsequestions/empty-form");
        View::show("stories/multiplechoicequestions/empty-form");
        View::show("stories/writtenresponsequestions/show", WrittenResponses::selectAllWrittenResponsesQuestions());
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