<?php

echo "<details class='stories-details'>
        <summary>Ajouter une question à choix multiples</summary>
        <h1>Formulaire d'ajout questions à choix multiples</h1>
        <form action='/stories/insertMultipleChoiceQuestion' method='post'>
            Module: <input type='text' name='module'><br>
            Description: <input type='text' name='description'><br>
            Question: <input type='text' name='question'><br>
            Réponse vraie <input type='number' name='true_answer' max='3' min='1'><br>
            Réponse 1: <input type='text' name='answer_1'><br>
            Réponse 2: <input type='text' name='answer_2'><br>
            Réponse 3: <input type='text' name='answer_3'><br>
            <input type='submit' name='add' value='Ajouter'>
        </form>
    </details>";