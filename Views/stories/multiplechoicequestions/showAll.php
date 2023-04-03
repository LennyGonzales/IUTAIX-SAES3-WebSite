<?php

echo "
    <details class='stories-details'>
        <summary>Voir/Modifier/Supprimer toutes les questions à choix multiples</summary>
        <section class='stories'>
                <table class='default-table'>
                    <thead>
                        <tr class='default-table-tr'>
                            <th>Id</th>
                            <th>Module</th>
                            <th>Description</th>
                            <th>Question</th>
                            <th>Réponse question</th>
                            <th>Réponse 1</th>
                            <th>Réponse 2</th>
                            <th>Réponse 3</th>
                            <th>% de réussite</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>";

foreach($A_view as $A_row) {
            echo " <tr class='default-table-tr'>
                        <td>" . $A_row['id'] . "</td>&nbsp;
                        <td>" . $A_row['module'] . "</td>&nbsp;
                        <td>" . $A_row['description'] . "</td>&nbsp;
                        <td>" . $A_row['question'] . "</td>&nbsp;
                        <td>" . $A_row['true_answer'] . "</td>
                        <td>" . $A_row['answer_1'] . "</td>
                        <td>" . $A_row['answer_2'] . "</td>
                        <td>" . $A_row['answer_3'] . "</td>
                        <td>" . $A_row['percentage'] . "</td>
                        <td><a href='/stories/showUpdateFormMultipleChoiceQuestion/" . $A_row['id'] . "' class='Mbutton'> Modifier</a></td>&nbsp;
                        <td><a href='/stories/deleteMultipleChoiceQuestion/" . $A_row['id'] . "' class='delete'>Supprimer</a></td>&nbsp;
                        <br>
                    </tr>";
}

echo "
                </tbody>
            </table>
        </section>
    </details>";