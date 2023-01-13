<?php
    require 'connectionSQL.php';

    /**
     * Fonction pour supprimer un QCM dans la base de données
     * @param con : connexion à la base de données
     * @param id : id du QCM à supprimer
     */
    function deleteQcm($con, $id) {
        // Préparation de la requête pour supprimer un QCM
        $statement = "DELETE FROM MULTIPLECHOICERESPONSES WHERE id=:id";
        $query = $con->prepare($statement);
        // Liaison de l'id à la requête
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        // Exécution de la requête
        $query->execute();
    }

    /**
     * Fonction pour supprimer une question à réponse libre dans la base de données
     * @param con : connexion à la base de données
     * @param id : id de la question à réponse libre à supprimer
     */
    function deleteWrittenResponseQuestion($con, $id) {
        // Préparation de la requête pour supprimer une question à réponse libre
        $statement = "DELETE FROM WRITTENRESPONSES where id = :id";
        $query = $con->prepare($statement);
        // Liaison de l'id à la requête
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        // Exécution de la requête
        $query->execute();
    }

    /**
     * Fonction pour supprimer une question de l'historique
     * @param con : connexion à la base de données
     * @param id : id de la question à supprimer de l'historique
     */
    function deleteHistory($con,$id) {
        // Préparation de la requête pour supprimer une question de l'historique
        $statement = "DELETE FROM STORIES WHERE id = :id";
        $query = $con->prepare($statement);
        // Liaison de l'id à la requête
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        // Exécution de la requête
        $query->execute();
    }

    // Récupération de l'id à partir des informations passées dans l'URL
    $id = intval($_GET['id']);

    // Vérification de la nature de la question (QCM ou question à réponse libre)
    if(isset($_GET['qcm'])) {
    // Suppression du QCM
    deleteQcm($con, $id);
    } else {
    // Suppression de la question à réponse libre
    deleteWrittenResponseQuestion($con,$id);
    }

    // Suppression de la question de l'historique
    deleteHistory($con,$id);

    // Redirection vers la page d'historique
    header("Location: pages/historyPage.php");
    exit();

?>