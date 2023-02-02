<?php

function getTextIfExists(array $A_view = null, string $S_columnName = null):string {
    if(isset($A_view[$S_columnName])) {
        return $A_view[$S_columnName];
    }
    return '';
}

echo "  <h1>Formulaire de modification d'une question à choix multiples</h1>
        <form action='/stories/updateMultipleChoiceQuestion' method='post'>
            <input type='hidden' name='id' value='" . getTextIfExists($A_view, "id") . "'><br>
            Module: <input type='text' name='module' value='" . getTextIfExists($A_view, "module") . "'><br>
            Description: <input type='text' name='description' value='" . getTextIfExists($A_view, "description") . "'><br>
            Question: <input type='text' name='question' value='" . getTextIfExists($A_view, "question") . "'><br>
            Réponse vraie <input type='number' name='true_answer' max='3' min='1' value='" . getTextIfExists($A_view, "true_answer") . "'><br>
            Réponse 1: <input type='text' name='answer_1' value='" . getTextIfExists($A_view, "answer_1") . "'><br>
            Réponse 2: <input type='text' name='answer_2' value='" . getTextIfExists($A_view, "answer_2") . "'><br>
            Réponse 3: <input type='text' name='answer_3' value='" . getTextIfExists($A_view, "answer_3") . "'><br>
            <input type='submit' name='add' value='Modifier'>
        </form>";