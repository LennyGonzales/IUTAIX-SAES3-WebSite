<?php
// Sélection des données de l'historique des questions à réponse écrite
$query = "SELECT h.id, h.module, h.description, h.question, wr.true_answer FROM history h INNER JOIN writtenresponse wr ON h.id = wr.id";
// Préparation de la requête
$stmt = $con->prepare($query);
// Exécution de la requête
$stmt->execute();
// Boucle pour afficher les données de chaque question
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
    <tr class="Rows">
        <td><?php echo $row['id']; ?></td>&nbsp;
        <td><?php echo $row['module']; ?></td>&nbsp;
        <td><?php echo $row['description']; ?></td>&nbsp;
        <td><?php echo $row['question']; ?></td>&nbsp;
        <td><?php echo $row['true_answer']; ?></td>&nbsp;
        <td><a href="historyPage.php?update=<?php echo $row['id'] ?>" class="Mbutton"> Modifier</a></td>&nbsp;
        <td><a href="../DeleteQuestion.php?id=<?php echo $row['id'] ?>" class="delete">Supprimer</a></td>&nbsp;
        <br>

    </tr>
    <?php
}
?>