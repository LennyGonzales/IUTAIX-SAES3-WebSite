<?php

echo "  <h1>Formulaire d'ajout questions à réponse écrite</h1>
        <form action='/stories/insertWrittenResponseQuestion' method='post'>
            Module: <input type='text' name='module'><br>
            Description: <input type='text' name='description'><br>
            Question: <input type='text' name='question'><br>
            Réponse vraie Ecrite: <input type='text' name='true_answer'><br>
            <input type='submit' name='add' value='Ajouter'>
        </form>";