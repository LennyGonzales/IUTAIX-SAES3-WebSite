<?php

class WrittenResponses extends Model
{
    public static function createWrittenResponse(Array $A_parameters = null):array {
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