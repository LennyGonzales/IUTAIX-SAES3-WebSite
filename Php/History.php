<?php

    /**
     * Fonction pour ajouter une question à l'historique
     * @param con : connexion à la base de données
     * @param description : description de la question
     * @param module : module de la question
     * @param question : question en elle-même
     */
    function addHistory($con, $description, $module, $question) {
        // Préparation de la requête pour insérer les données dans la table history
        $statement ="INSERT INTO STORIES (module, question, description) VALUES (:module, :question, :description);";
        $query=$con->prepare($statement);
        // Liaison des variables à la requête
        $query->bindValue(':description',$description,PDO::PARAM_STR);
        $query->bindValue(':module',$module,PDO::PARAM_STR);
        $query->bindValue(':question',$question,PDO::PARAM_STR);
        // Exécution de la requête
        $query->execute();
    }

    /**
     * Fonction pour récupérer l'id d'une question de l'historique
     * @param con : connexion à la base de données
     * @param module : module de la question
     * @param description : description de la question
     * @param question : question en elle-même
     * @return id : id de la question dans la base de données
     */
    function getIdFromHistory($con, $module, $description, $question) {
        // Préparation de la requête pour récupérer l'id de la question
        $statement ="SELECT ID FROM STORIES WHERE module = :module and question = :question and description = :description;";
        $query=$con->prepare($statement);
        // Liaison des variables à la requête
        $query->bindValue(':description',$description,PDO::PARAM_STR);
        $query->bindValue(':module',$module,PDO::PARAM_STR);
        $query->bindValue(':question',$question,PDO::PARAM_STR);
        // Exécution de la requête
        $query->execute();
        // Récupération de l'id de la question
        $id = $query->fetch();
        return $id['id'];
    }

    /**
     * Fonction pour mettre à jour une question de l'historique
     * @param con : connexion à la base de données
     * @param id : id de la question à mettre à jour
     * @param module : nouveau module de la question
     * @param description : nouvelle description de la question
     * @param question : nouvelle question
     */
    function updateHistory($con, $id, $module, $description, $question) {
        // Préparation de la requête pour mettre à jour les données dans la table history
        $sql="UPDATE STORIES SET module = :module, question = :question, description = :description WHERE id = :id;";
        $queryh=$con->prepare($sql);
        // Liaison des variables à la requête
        $queryh->bindValue(':description',$description,PDO::PARAM_STR);
        $queryh->bindValue(':module',$module,PDO::PARAM_STR);
        $queryh->bindValue(':question',$question,PDO::PARAM_STR);
        $queryh->bindValue(':id',$id,PDO::PARAM_INT);
        // Exécution de la requête
        $queryh->execute();
        }
    
?>
