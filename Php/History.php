<?php

function addHistory($con, $description, $module, $question) {
    $statement ="INSERT INTO history (module, question, description) VALUES (:module, :question, :description);";
    $query=$con->prepare($statement);
    $query->bindValue(':description',$description,PDO::PARAM_STR);
    $query->bindValue(':module',$module,PDO::PARAM_STR);
    $query->bindValue(':question',$question,PDO::PARAM_STR);
    $query->execute();
}

function getIdFromHistory($con, $module, $description, $question) {
    $statement ="SELECT ID FROM HISTORY WHERE module = :module and question = :question and description = :description;";
    $query=$con->prepare($statement);
    $query->bindValue(':description',$description,PDO::PARAM_STR);
    $query->bindValue(':module',$module,PDO::PARAM_STR);
    $query->bindValue(':question',$question,PDO::PARAM_STR);
    $query->execute();
    $id = $query->fetch();
    return $id['id'];
}

function updateHistory($con, $id, $module, $description, $question) {
    $sql="UPDATE history SET module = :module, question = :question, description = :description WHERE id = :id;";
    $queryh=$con->prepare($sql);
    $queryh->bindValue(':description',$description,PDO::PARAM_STR);
    $queryh->bindValue(':module',$module,PDO::PARAM_STR);
    $queryh->bindValue(':question',$question,PDO::PARAM_STR);
    $queryh->bindValue(':id',$id,PDO::PARAM_INT);
    $queryh->execute();
}