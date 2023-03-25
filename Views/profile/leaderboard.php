<?php

echo "
    <section class='leaderboard'>
        <h1>Classement général</h1>

        <table>
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Mail universitaire</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
        ";
foreach ($A_view as $A_user) {
        echo "  <tr>
                    <td class='autoIncrementColumn'></td>
                    <td>" . $A_user['email'] . "</td>
                    <td>" . $A_user['points'] . "</td>
                </tr>";
}
echo "
            </tbody>
        </table>
   </section>
";