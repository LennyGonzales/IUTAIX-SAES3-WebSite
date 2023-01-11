
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Css/scenario-style.css">
        <title>Modifications/ajouter des questions</title>
    </head>
    <body>
 
        <form action="./acceuil.php">
            <input type="submit" value="Accueil">
        </form>


        <?php
        
        require("./connectionSQL.php");
        $modify ="";
        $delete="";
        ?>
        <div class="tabla-responsive">
            <table class="table-bordered">
                <thead>
                    <h1>Tableau questions à choix multiples</h1> 
                    <tr class="column">
                        <th>Id</th>
                        <th>Module</th>
                        <th>Description</th>
                        <th>Question</th>
                        <th>Réponse question</th>
                        <th>Réponse 1</th>
                        <th>Réponse 2</th>
                        <th>Réponse 3</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php
                    $query = "SELECT h.id, h.module, h.description, h.question, q.true_answer, q.answer_1, q.answer_2, q.answer_3 FROM history h INNER JOIN qcm q ON h.id = q.id";
                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <tr class="Rows">
                            <td><?php echo $row['id']; ?></td>&nbsp;
                            <td><?php echo $row['module']; ?></td>&nbsp;
                            <td><?php echo $row['description']; ?></td>&nbsp;
                            <td><?php echo $row['question']; ?></td>&nbsp;
                            <td><?php echo $row['true_answer']; ?></td>&nbsp;
                            <td><?php echo $row['answer_1']; ?></td>&nbsp;
                            <td><?php echo $row['answer_2']; ?></td>&nbsp;
                            <td><?php echo $row['answer_3']; ?></td>&nbsp;
                            <td><a href="history.php?modify=<?php echo $row['id'] ?>&typeqcm=true" class="Mbutton"> Modifier</a></td>&nbsp;
                            <td><a href="history.php?delete=<?php echo $row['id'] ?>" class="delete">Supprimer</a></td>&nbsp;
                            <br>
                        
                        </tr>
                    <?php
                    }
                    ?>
     
                </tbody>
            </table>
        </div>



        <div class="tabla-responsive">
            <table class="table-bordered">
                <thead>
                    <h1>Tableau questions à choix multiples</h1> 
                    <tr class="column">
                        <th>Id</th>
                        <th>Module</th>
                        <th>Description</th>
                        <th>Question</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php
                    $query = "SELECT * FROM history";
                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <tr class="Rows">
                            <td><?php echo $row['id']; ?></td>&nbsp;
                            <td><?php echo $row['module']; ?></td>&nbsp;
                            <td><?php echo $row['description']; ?></td>&nbsp;
                            <td><?php echo $row['question']; ?></td>&nbsp;
                            <td><a href="history.php?modify=<?php echo $row['id'] ?>&typeqcm=true" class="Mbutton"> Modifier</a></td>&nbsp;
                            <td><a href="history.php?delete=<?php echo $row['id'] ?>" class="delete">Supprimer</a></td>&nbsp;
                            <br>
                        
                        </tr>
                    <?php
                    }
                    ?>
     
                </tbody>
            </table>
        </div>








        <div class="tabla-responsive">
            <table class="table-bordered">
                <thead>
                    <thead> 
                    <tr class="column">
                        <CAPTION ALIGN="TOP">titre haut du tableau </CAPTION>  
                        <th>Id</th>
                        <th>Module</th>
                        <th>Description</th>
                        <th>Question</th>
                        <th>Réponse question Ecrite</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                    <?php   
                    $query = "SELECT h.id, h.module, h.description, h.question, wr.true_answer FROM history h INNER JOIN writtenresponse wr ON h.id = wr.id";
                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <tr class="Rows">
                            <td><?php echo $row['id']; ?></td>&nbsp;
                            <td><?php echo $row['module']; ?></td>&nbsp;
                            <td><?php echo $row['description']; ?></td>&nbsp;
                            <td><?php echo $row['question']; ?></td>&nbsp;
                            <td><?php echo $row['true_answer']; ?></td>&nbsp;
                            <td><a href="history.php?modify=<?php echo $row['id'] ?>" class="Mbutton"> Modifier</a></td>&nbsp;
                            <td><a href="history.php?delete=<?php echo $row['id'] ?>" class="delete">Supprimer</a></td>&nbsp;
                            <br>
                        
                        </tr>
                    <?php
                    }
                    ?>
     
                </tbody>
            </table>
        </div>
        
        <br>
        <br>
        <br>
        <?php
        //Supprimer les questions
        if(isset($_GET['delete'])){
            $delete = $_GET['delete'];
            // delete from history and qcm
            $sqldel="DELETE FROM history, qcm USING history INNER JOIN qcm 
                    WHERE history.id = :id AND qcm.history_id = :id";
            $querydel=$con->prepare($sqldel);
            $querydel->bindValue(':id',$delete,PDO::PARAM_STR);
            $qWR=$querydel->execute();
    
            // delete from history and writtenresponse
            $sqldel="DELETE FROM history, writtenresponse USING history INNER JOIN writtenresponse 
                    WHERE history.id = :id AND writtenresponse.history_id = :id";
            $querydel=$con->prepare($sqldel);
            $querydel->bindValue(':id',$delete,PDO::PARAM_STR);
            $qDel=$querydel->execute();

            $sqlDel="DELETE from history WHERE id = :id";
            $queryDel=$con->prepare($sqlDel);
            $queryDel->bindValue(':id',$delete,PDO::PARAM_STR);
            $qtest=$queryDel->execute();
    
            if ( $qtest || $qWR || $qDel) {
                echo "suppression successful";
                echo "<script>location.href='history.php';</script>";
            } else {
                echo "suppression unsuccessful";
                echo "<script>location.href='history.php';</script>";
            }
        }
        ?>

<?php 

if (isset($_POST['modify'])) {
    $id =  $_POST['id'] ;
    $module =  $_POST['module'] ;
    $description =  $_POST['description'] ;
    $question = $_POST['question'] ;
    $true_answer =  $_POST['true_answer'] ;
    $qQCM = false;
    $qWR = false;
    if (isset($_GET['typeqcm'])) {
        $answer_1 =  $_POST['answer_1'];
        $answer_2 = $_POST['answer_2'] ;
        $answer_3 =  $_POST['answer_3'] ;
        $qcmsql="UPDATE qcm
        SET true_answer = :true_answer, answer_1 = :answer_1, answer_2 = :answer_2, answer_3 =:answer_3 
        WHERE id = :id;";
        $queryQCM = $con->prepare($qcmsql);
        $queryQCM->bindValue(':true_answer',$true_answer,PDO::PARAM_INT);
        $queryQCM->bindValue(':answer_1',$answer_1,PDO::PARAM_STR);
        $queryQCM->bindValue(':answer_2',$answer_2,PDO::PARAM_STR);
        $queryQCM->bindValue(':answer_3',$answer_3,PDO::PARAM_STR);
        $queryQCM->bindValue(':id',$id,PDO::PARAM_INT);
        $qQCM = $queryQCM->execute();
    } else {
        $sqlwr ="UPDATE writtenresponse SET true_answer = :true_answer WHERE id = :id;";
        $queryWR = $con->prepare($sqlwr);
        $queryWR->bindValue(':true_answer',$true_answer,PDO::PARAM_INT);
        $queryWR->bindValue(':id',$id,PDO::PARAM_INT);
        $qWR = $queryWR->execute();
    }

    $sql="UPDATE history SET module = :module, question = :question, description = :description WHERE id = :id;";
    $queryh=$con->prepare($sql);
    $queryh->bindValue(':description',$description,PDO::PARAM_STR);
    $queryh->bindValue(':module',$module,PDO::PARAM_STR);
    $queryh->bindValue(':question',$question,PDO::PARAM_STR);
    $queryh->bindValue(':id',$id,PDO::PARAM_INT);
    $qHIS=$queryh->execute();

    if ($qQCM || $qWR) {
        echo "modification successful";
        echo "<script>location.href='history.php';</script>";

    } else {
        echo "modification unsuccessful";
        echo "<script>location.href='history.php';</script>";
    }
}


?>


<?php
if(isset($_GET['modify'])){
    $modify = intval($_GET['modify']);
    if(isset($_GET['typeqcm'])){
        $q = "SELECT h.id, h.module, h.description, h.question, q.true_answer, q.answer_1, q.answer_2, q.answer_3 FROM history h INNER JOIN qcm q ON h.id = q.id WHERE h.id=:modify";
    }else{
        $q = "SELECT h.id, h.module, h.description, h.question, wr.true_answer FROM history h INNER JOIN writtenresponse wr ON h.id = wr.id WHERE h.id=:modify";
    }
    $query = $con->prepare($q);
    $query->bindValue(':modify',$modify,PDO::PARAM_INT); 
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    ?>
<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
    <label for="module">Module</label>
    <input type="text" name="module" id="module" value="<?php echo $row['module'] ?>" />
    <label for="description">Description</label>
    <input type="text" name="description" id="description" value="<?php echo $row['description'] ?>" />
    <label for="question">Question</label>
    <input type="text" name="question" id="question" value="<?php echo $row['question'] ?>" />
    <label for="true_answer">Vraie réponse</label>
    <input type="text" name="true_answer" id="true_answer" value="<?php echo $row['true_answer'] ?>" />
  
    <?php
    if(isset($_GET['typeqcm'])){
        echo("
        <label for= 'answer_1'>Réponse 1</label>
        <input type='text' name='answer_1' id='answer_1' value='". $row['answer_1']."' />
        <label for='answer_2'>Réponse 2</label>
        <input type='text' name='answer_2' id='answer_2' value='". $row['answer_2'] ."' />
        <label for='answer_3'>Réponse 3</label>
        <input type='text' name='answer_3' id='answer_3' value='".$row['answer_3'] ."' /> ");
    }
    ?>
    
    <input type="submit" value="Mettre à jour" name="modify" />
</form>

<?php
}

if (isset($_POST['add'])) {
    $module =  $_POST['module'] ?? null;
    $description =  $_POST['description'] ?? null;
    $question = $_POST['question'] ?? null;
    $true_answer =  $_POST['true_answer'] ?? null;
    $qQCM = false;
    $qWR = false;

    if (isset($_GET['typeqcm'])) {
        $answer_1 =  $_POST['answer_1'] ?? null;
        $answer_2 = $_POST['answer_2'] ?? null;
        $answer_3 =  $_POST['answer_3'] ?? null;

        if ($module && $description && $question && $true_answer && $answer_1 && $answer_2 && $answer_3) {
            $qcmsql="INSERT INTO qcm (true_answer, answer_1, answer_2, answer_3) 
            VALUES (:true_answer, :answer_1, :answer_2, :answer_3);";
            $queryQCM = $con->prepare($qcmsql);
            $queryQCM->bindValue(':true_answer',$true_answer,PDO::PARAM_INT);
            $queryQCM->bindValue(':answer_1',$answer_1,PDO::PARAM_STR);
            $queryQCM->bindValue(':answer_2',$answer_2,PDO::PARAM_STR);
            $queryQCM->bindValue(':answer_3',$answer_3,PDO::PARAM_STR);
            $qQCM = $queryQCM->execute();
        }
    } else {
        if ($module && $description && $question && $true_answer) {
            $sqlwr ="INSERT INTO writtenresponse (true_answer) VALUES (:true_answer);";
            $queryWR = $con->prepare($sqlwr);
            $queryWR->bindValue(':true_answer',$true_answer,PDO::PARAM_INT);
            $qWR = $queryWR->execute();
        }
    }

    if ($module && $description && $question) {
        $sql="INSERT INTO history (module, question, description) VALUES (:module, :question, :description);";
        $queryh=$con->prepare($sql);
        $queryh->bindValue(':description',$description,PDO::PARAM_STR);
        $queryh->bindValue(':module',$module,PDO::PARAM_STR);
        $queryh->bindValue(':question',$question,PDO::PARAM_STR);
        $qHIS=$queryh->execute();
    }

    if ($qQCM || $qWR) {
        echo "ajout successful";
        echo "<script>location.href='history.php';</script>";

    } else {
        echo "ajout unsuccessful";
        echo "<script>location.href='history.php';</script>";
    }
}
?>

<form action="" method="post">
  Module: <input type="text" name="module"><br>
  Description: <input type="text" name="description"><br>
  Question: <input type="text" name="question"><br>
  Réponse vraie Ecrite: <input type="text" name="true_answer"><br>
  <input type="checkbox" name="typeqcm" value="qcm"> QCM <br>
  Réponse vraie <input type="typeqcm" name="true_answer"><br>
  Réponse 1: <input type="text" name="answer_1"><br>
  Réponse 2: <input type="text" name="answer_2"><br>
  Réponse 3: <input type="text" name="answer_3"><br>
  <input type="submit" name="add" value="Ajouter">
</form>
    </body>
</html>