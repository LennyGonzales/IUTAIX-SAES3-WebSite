<?php
// Connexion à la base de données
require 'connectionSQL.php';
// Inclusion de la classe History
require 'History.php';

/**
 * Fonction pour mettre à jour les données d'une question à choix multiple (QCM) dans la base de données
 *
 * @param object $con La connexion à la base de données
 * @param int $id L'ID de la question à mettre à jour
 * @param int $true_answer L'ID de la réponse correcte
 * @param string $answer_1 La première réponse possible
 * @param string $answer_2 La deuxième réponse possible
 * @param string $answer_3 La troisième réponse possible
 */
function updateQcm($con, $id, $true_answer, $answer_1, $answer_2, $answer_3){
    // Requête SQL pour mettre à jour les données d'une question à choix multiple
    $statement="UPDATE MULTIPLECHOICERESPONSES SET true_answer = :true_answer, answer_1 = :answer_1, answer_2 = :answer_2, answer_3 =:answer_3 WHERE id = :id;";
    $query = $con->prepare($statement);
    // Liaison des valeurs à la requête préparée
    $query->bindValue(':true_answer',$true_answer,PDO::PARAM_INT);
    $query->bindValue(':answer_1',$answer_1,PDO::PARAM_STR);
    $query->bindValue(':answer_2',$answer_2,PDO::PARAM_STR);
    $query->bindValue(':answer_3',$answer_3,PDO::PARAM_STR);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    // Exécution de la requête
    $query->execute();
}

/**
 * Fonction pour mettre à jour les données d'une question à réponse écrite dans la base de données
 *
 * @param object $con La connexion à la base de données
 * @param int $id L'ID de la question à mettre à jour
 * @param int $true_answer L'ID de la réponse correcte
 */
function updateWrittenResponseQuestion($con, $id, $true_answer) {
    // Requête SQL pour mettre à jour les données d'une question à réponse écrite
    $statement ="UPDATE WRITTENRESPONSES SET true_answer = :true_answer WHERE id = :id;";
    $query = $con->prepare($statement);
    // Liaison des valeurs à la requête préparée
    $query->bindValue(':true_answer',$true_answer,PDO::PARAM_INT);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    // Exécution de la requête
    $query->execute();
}

// Récupération des données envoyées via le formulaire
$id = $_POST['id'] ;
$module = $_POST['module'] ;
$description = $_POST['description'] ;
$question = $_POST['question'] ;
$true_answer = $_POST['true_answer'] ;
$answer_1 = $_POST['answer_1'];
$answer_2 = $_POST['answer_2'] ;
$answer_3 = $_POST['answer_3'] ;

// Mise à jour de l'historique de la question
updateHistory($con, $id, $module, $description, $question);

// Vérification si la question est à choix multiple ou à réponse écrite
// Mise à jour des données de la question en conséquence
if ($answer_1 || $answer_2 || $answer_3) {
updateQcm($con, $id, $true_answer, $answer_1, $answer_2, $answer_3);
} else {
updateWrittenResponseQuestion($con, $id, $true_answer);
}

// Redirection vers la page d'historique
header('Location: pages/historyPage.php');
exit();