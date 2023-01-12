<?php
require 'connectionSQL.php';

function editForm($con, $id) {
    if(isset($_GET['qcm'])){
        $q = "SELECT h.id, h.module, h.description, h.question, q.true_answer, q.answer_1, q.answer_2, q.answer_3 FROM history h INNER JOIN qcm q ON h.id = q.id WHERE h.id=:id";
    }else{
        $q = "SELECT h.id, h.module, h.description, h.question, wr.true_answer FROM history h INNER JOIN writtenresponse wr ON h.id = wr.id WHERE h.id=:id";
    }
    $query = $con->prepare($q);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}


$id = intval($_GET['update']);
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

