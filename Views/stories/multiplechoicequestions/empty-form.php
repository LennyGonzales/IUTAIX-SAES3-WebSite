<?php

echo "<details class='stories-details'>
        <summary>Ajouter une question à choix multiples</summary>
        <form class='default-form stories-add-form' action='/stories/insertMultipleChoiceQuestion' method='post'>
            Module: <input type='text' name='module' required><br>
            Description: <input type='text' name='description' required><br>
            Question: <input type='text' name='question' required><br>
            Réponse vraie <input type='number' name='true_answer' max='3' min='1' required><br>
            Réponse 1: <input type='text' name='answer_1' required><br>
            Réponse 2: <input type='text' name='answer_2' required><br>
            Réponse 3: <input type='text' name='answer_3' required><br>
            <input type='submit' name='add' value='Ajouter'>
        </form>
    </details>";