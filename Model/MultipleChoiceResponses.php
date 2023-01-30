<?php

class MultipleChoiceResponses extends Model
{
    public static function createMultipleChoiceResponse(Array $A_parameters = null):array {
        if(!self::create($A_parameters)) {
            return array(
                'messageType' => 'error',
                'message' => 'L\'ajout d\'une question à échoué, veuillez réésayer.'
            );
        }
        return array(
            'messageType' => 'successful',
            'message' => 'La question a été ajouté !'
        );
    }
}