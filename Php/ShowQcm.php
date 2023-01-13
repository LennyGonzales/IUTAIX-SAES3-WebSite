<?php
require "connectionSQL.php";

// Requête SQL pour récupérer les données de toutes les questions à choix multiple de la base de données
$query = "SELECT s.id, s.module, s.description, s.question, m.true_answer, m.answer_1, m.answer_2, m.answer_3 FROM STORIES s INNER JOIN MULTIPLECHOICERESPONSES m ON s.id = m.id";

// Préparation de la requête
$stmt = $con->prepare($query);

// Exécution de la requête
$stmt->execute();

// Boucle pour afficher toutes les questions
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
        <td><?php echo $row['answer_3']; ?></td>&nbsp;
        <td><a href="historyPage.php?qcm=true&update=<?php echo $row['id'] ?>" class="Mbutton"> Modifier</a></td>&nbsp;
        <td><a href="../DeleteQuestion.php?qcm=true&id=<?php echo $row['id'] ?>" class="delete">Supprimer</a></td>&nbsp;
        <br>

    </tr>
    <?php
}
?>