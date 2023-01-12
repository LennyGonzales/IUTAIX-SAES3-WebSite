<?php
require 'connectionSQL.php';

function deleteQcm($con, $id) {
    $statement = "DELETE FROM QCM WHERE id=:id";
    $query = $con->prepare($statement);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
}

function deleteWrittenResponseQuestion($con, $id) {
    $statement = "DELETE FROM WRITTENRESPONSE where id = :id";
    $query = $con->prepare($statement);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
}

function deleteHistory($con,$id) {
    $statement = "DELETE from HISTORY WHERE id = :id";
    $query = $con->prepare($statement);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
}

$id = intval($_GET['id']);
if(isset($_GET['qcm'])) {
    deleteQcm($con, $id);
} else {
    deleteWrittenResponseQuestion($con,$id);
}
deleteHistory($con,$id);


header("Location: historyPage.php");
exit();