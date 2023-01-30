<?php

final class StoriesController
{
    public function defaultAction(array $A_message = null):void {
        if($A_message != null) {
            View::show("message", $A_message);
        }
        View::show("stories/writtenresponsequestions/empty-form");
    }

    public function createAction(Array $A_parametres = null, Array $A_postParams = null):void {
        $A_row = array(
            'module' => $A_postParams['module'],
            'description' => $A_postParams['description'],
            'question' => $A_postParams['question']
        );
        $A_status = Stories::createStory($A_row);
        if($A_status['messageType'] == 'error') {    // Insert the module, description and question in the Stories table
            self::defaultAction($A_status);
            exit;
        }

        $S_id = Stories::selectId($A_row);  // Get the id of the story
        $A_row = array(     // Prepare the array
            'id' => $S_id,
            'true_answer' => $A_postParams['true_answer']
        );

        $A_status = WrittenResponses::createWrittenResponse($A_row);
        self::defaultAction($A_status);
    }
}