<?php
require "connectionSQL.php";

$query = "SELECT h.id, h.module, h.description, h.question, q.true_answer, q.answer_1, q.answer_2, q.answer_3 FROM history h INNER JOIN qcm q ON h.id = q.id";
$stmt = $con->prepare($query);
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
    <tr class="Rows">
        <td><?php echo $row['id']; ?></td>&nbsp;
        <td><?php echo $row['module']; ?></td>&nbsp;
        <td><?php echo $row['description']; ?></td>&nbsp;
        <td><?php echo $row['question']; ?></td>&nbsp;
        <td><?php echo $row['true_answer']; ?></td>&nbsp;
        <td><?php echo $row['answer_1']; ?></td>&nbsp;
        <td><?php echo $row['answer_2']; ?></td>&nbsp;
        <td><?php echo $row['answer_3']; ?></td>
        <td><a href="pages/historyPage.php?qcm=true&update=<?php echo $row['id'] ?>" class="Mbutton"> Modifier</a></td>&nbsp;
        <td><a href="DeleteQuestion.php?qcm=true&id=<?php echo $row['id'] ?>" class="delete">Supprimer</a></td>&nbsp;
        <br>

    </tr>
    <?php
}