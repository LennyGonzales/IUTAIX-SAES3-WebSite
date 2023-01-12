<?php
require 'connectionSQL.php';
require 'History.php';

function updateQcm($con, $id, $true_answer, $answer_1, $answer_2, $answer_3){
    $statement="UPDATE qcm SET true_answer = :true_answer, answer_1 = :answer_1, answer_2 = :answer_2, answer_3 =:answer_3 WHERE id = :id;";
    $query = $con->prepare($statement);
    $query->bindValue(':true_answer',$true_answer,PDO::PARAM_INT);
    $query->bindValue(':answer_1',$answer_1,PDO::PARAM_STR);
    $query->bindValue(':answer_2',$answer_2,PDO::PARAM_STR);
    $query->bindValue(':answer_3',$answer_3,PDO::PARAM_STR);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
}

function updateWrittenResponseQuestion($con, $id, $true_answer) {
    $statement ="UPDATE writtenresponse SET true_answer = :true_answer WHERE id = :id;";
    $query = $con->prepare($statement);
    $query->bindValue(':true_answer',$true_answer,PDO::PARAM_INT);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
}


$id =  $_POST['id'] ;
$module =  $_POST['module'] ;
$description =  $_POST['description'] ;
$question = $_POST['question'] ;
$true_answer =  $_POST['true_answer'] ;
$answer_1 =  $_POST['answer_1'];
$answer_2 = $_POST['answer_2'] ;
$answer_3 =  $_POST['answer_3'] ;

updateHistory($con, $id, $module, $description, $question);
if ($answer_1 || $answer_2 || $answer_3) {
    updateQcm($con, $id, $true_answer, $answer_1, $answer_2, $answer_3);
} else {
    updateWrittenResponseQuestion($con, $id, $true_answer);
}

header('Location: historyPage.php');
exit();