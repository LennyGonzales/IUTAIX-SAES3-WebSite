<?php

function getTextIfExists(array $A_view = null, string $S_columnName = null):string {
    if(isset($A_view[$S_columnName])) {
        return $A_view[$S_columnName];
    }
    return '';
}

echo "  <h1>Formulaire de modification d'une question à choix multiples</h1>
        <form action='/stories/updateWrittenResponseQuestion' method='post'>
            <input type='hidden' name='id' value='" . getTextIfExists($A_view, "id") . "'><br>
            Module: <input type='text' name='module' value='" . getTextIfExists($A_view, "module") . "'><br>
            Description: <input type='text' name='description' value='" . getTextIfExists($A_view, "description") . "'><br>
            Question: <input type='text' name='question' value='" . getTextIfExists($A_view, "question") . "'><br>
            Réponse vraie <input type='text' name='true_answer' max='3' min='1' value='" . getTextIfExists($A_view, "true_answer") . "'><br>
            <input type='submit' name='add' value='Modifier'>
        </form>";