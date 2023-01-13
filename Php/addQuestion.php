<?php

    // Importe les fichiers de connexion à la base de données et de gestion de l'historique
    require("./connectionSQL.php");
    require("./History.php");

    // Fonction pour ajouter une question à choix multiple
    function addQcm($con, $id, $true_answer, $answer_1, $answer_2, $answer_3) {
        // Préparation de la requête d'insertion
        $statement="INSERT INTO MULTIPLECHOICERESPONSES (id, true_answer, answer_1, answer_2, answer_3) 
        VALUES (:id, :true_answer, :answer_1, :answer_2, :answer_3);";
        // Préparation de la requête pour éviter les injections SQL
        $query = $con->prepare($statement);
        // Liaison des valeurs à insérer aux paramètres de la requête
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->bindValue(':true_answer',$true_answer,PDO::PARAM_INT);
        $query->bindValue(':answer_1',$answer_1,PDO::PARAM_STR);
        $query->bindValue(':answer_2',$answer_2,PDO::PARAM_STR);
        $query->bindValue(':answer_3',$answer_3,PDO::PARAM_STR);
        // Exécution de la requête
        $query->execute();
    }

    // Fonction pour ajouter une question à réponse libre
    function addWrittenResponseQuestion($con, $id, $true_answer) {
        // Préparation de la requête d'insertion
        $statement ="INSERT INTO WRITTENRESPONSES (id, true_answer) VALUES (:id, :true_answer);";
        // Préparation de la requête pour éviter les injections SQL
        $query = $con->prepare($statement);
        // Liaison des valeurs à insérer aux paramètres de la requête
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->bindValue(':true_answer',$true_answer,PDO::PARAM_STR);
        // Exécution de la requête
        $query->execute();
    }

    // Récupération des données envoyées par le formulaire
    $module =  $_POST['module'] ?? null;
    $description =  $_POST['description'] ?? null;
    $question = $_POST['question'] ?? null;
    $true_answer =  $_POST['true_answer'] ?? null;
    $answer_1 =  $_POST['answer_1'] ?? null;
    $answer_2 = $_POST['answer_2'] ?? null;
    $answer_3 =  $_POST['answer_3'] ?? null;

    // Ajout de la question dans l'historique
    addHistory($con, $module, $description, $question);

    // Récupération de l'id de la question dans l'historique
    $id = getIdFromHistory($con, $module, $description, $question);

    // Vérification si la question est à choix multiple ou à réponse libre
    if ($answer_1 || $answer_2 || $answer_3) {
    // Ajout de la question à choix multiple dans la base de données
    addQcm($con, $id, $true_answer, $answer_1, $answer_2, $answer_3);
    } else {
    // Ajout de la question à réponse libre dans la base de données
    addWrittenResponseQuestion($con, $id, $true_answer);
    }

    // Redirection vers la page d'historique
    header("Location: pages/historyPage.php");
    exit();

?>
