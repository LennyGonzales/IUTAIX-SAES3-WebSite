<?php

echo "
<div class='table-responsive'>
            <table class='table-bordered'>
            <Caption>Tableau questions à réponse écrite</Caption>
            <br>
                <thead>
                        <tr class='column'><th>Id</th>
                            <th>Module</th>
                            <th>Description</th>
                            <th>Question</th>
                            <th>Réponse question Ecrite</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                </thead>
                <tbody>";

foreach($A_view as $A_row) {
    echo "  <tr class='Rows'>
                <td>" . $A_row['id'] . "</td>&nbsp;
                <td>" . $A_row['module'] . "</td>&nbsp;
                <td>" . $A_row['description'] . "</td>&nbsp;
                <td>" . $A_row['question'] . "</td>&nbsp;
                <td>" . $A_row['true_answer'] . "</td>&nbsp;
                <td><a href='' class='Mbutton'> Modifier</a></td>&nbsp;
                <td><a href='' class='delete'>Supprimer</a></td>&nbsp;
                <br>
            </tr>";
}

echo "
        </tbody>
    </table>
</div>";
