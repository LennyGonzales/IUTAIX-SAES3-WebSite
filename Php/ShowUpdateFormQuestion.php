<?php
require 'connectionSQL.php';

/**
 * Fonction pour récupérer les données d'une question pour remplir un formulaire de modification
 *
 * @param object $con La connexion à la base de données
 * @param int $id L'ID de la question à récupérer
 * @return array Les données de la question
 */
function editForm($con, $id) {
    // Requête SQL pour récupérer les données d'une question à choix multiple
    if(isset($_GET['qcm'])){
        $q = "SELECT s.id, s.module, s.description, s.question, m.true_answer, m.answer_1, m.answer_2, m.answer_3 FROM STORIES s INNER JOIN MULTIPLECHOICERESPONSES m ON s.id = m.id WHERE s.id=:id";
    }else{
        // Requête SQL pour récupérer les données d'une question à réponse écrite
        $q = "SELECT s.id, s.module, s.description, s.question, w.true_answer FROM STORIES s INNER JOIN WRITTENRESPONSES w ON s.id = w.id WHERE s.id=:id";
    }
    // Préparation de la requête
    $query = $con->prepare($q);
    // Liaison des valeurs
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    // Exécution de la requête
    $query->execute();
    // Renvoi des données de la question
    return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    // Récupération de l'ID de la question à modifier à partir de l'URL
    $id = intval($_GET['update']);
    // Récupération des données de la question à partir de la fonction editForm
    $query = editForm($con, $id);
    ?>
    
    <form action="../UpdateQuestion.php" method="post">
        <input type="hidden" name="id" value="<?php echo $query['id'] ?>" />
        <label for="module">Module</label>
        <input type="text" name="module" id="module" value="<?php echo $query['module'] ?>" />
        <label for="description">Description</label>
        <input type="text" name="description" id="description" value="<?php echo $query['description'] ?>" />
        <label for="question">Question</label>
        <input type="text" name="question" id="question" value="<?php echo $query['question'] ?>" />
        <label for="true_answer">Vraie réponse</label>
        <?php
        // Vérification si la question est à choix multiple ou à réponse écrite
        if(isset($_GET['qcm'])) {
        ?>
            <input type="number" name="true_answer" id="true_answer" min="1" max="3" value="<?php echo $query['true_answer'] ?>" />
            <label for= 'answer_1'>Réponse 1</label>
            <input type='text' name='answer_1' id='answer_1' value="<?php echo $query['answer_1'] ?>" />
            <label for='answer_2'>Réponse 2</label>
            <input type='text' name='answer_2' id='answer_2' value="<?php echo $query['answer_2'] ?>" />
            <label for='answer_3'>Réponse 3</label>
            <input type='text' name='answer_3' id='answer_3' value="<?php echo $query['answer_3'] ?>" />
        <?php
        } else {
        ?>
            <input type="text" name="true_answer" id="true_answer" value="<?php echo $query['true_answer'] ?>" />
        <?php
        }
        ?>
        <input type="submit" value="Mettre à jour" name="update" />
    </form>