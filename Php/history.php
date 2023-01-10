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
        ?>
        <div class="tabla-responsive">
            <table class="table-bordered">
                <thead>
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
            $id=$_GET['delete'];
            $sql="DELETE FROM QCM_FR WHERE ID='$id'";
            $query=pg_query($sql);
            if($query){
                echo "Supprimer avec succes.";
                header("refresh:1; url=history.php");
            }else{
                echo "ça n'a pas été supprimé.";
                header("refresh:1; url=history.php");
            }
        }

        //Modifier les questions
        if(isset($_POST['modify'])){
            $id = $_POST['id'];
            $module = $_POST['module'];
            $question = $_POST['question'];
            $true_answer = $_POST['true_answer'];
            $answer_1 = $_POST['answer_1'];
            $answer_2 = $_POST['answer_2'];
            $answer_3 = $_POST['answer_3'];
                
            $query = "UPDATE qcm_fr SET module='$module', question='$question', true_answer='$true_answer', answer_1='$answer_1', answer_2='$answer_2', answer_3='$answer_3' WHERE id='$id'";
            $q = pg_query($con, $query);
            if($q){
                echo "modification successful";
                    header("refresh:1; url=history.php");
                }else{
                    echo "modification unsuccessful";
                    header("refresh:1; url=history.php");
                }
            }

            if(isset($_GET['modify'])){
                $modify = $_GET['modify'];
                $q = "SELECT * FROM qcm_fr WHERE id='$modify'";
                $query = pg_query($con, $q);
                $row = pg_fetch_assoc($query);
                ?>
                <form action="history.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="form-group">
                    <label for="module">Module:</label>
                    <input type="text" class="form-control" id="module" name="module" value="<?php echo $row['module']; ?>">
                </div>
                <div class="form-group">
                    <label for="question">Question:</label>
                    <input type="text" class="form-control" id="question" name="question" value="<?php echo $row['question']; ?>">
                </div>
                <div class="form-group">
                    <label for="true_answer">Réponse vraie:</label>
                    <input type="text" class="form-control" id="true_answer" name="true_answer" value="<?php echo $row['true_answer']; ?>">
                </div>
                <div class="form-group">
                    <label for="answer_1">Réponse 1:</label>
                    <input type="text" class="form-control" id="answer_1" name="answer_1" value="<?php echo $row['answer_1']; ?>">
                </div>
                <div class="form-group">
                    <label for="answer_2">Réponse 2:</label>
                    <input type="text" class="form-control" id="answer_2" name="answer_2" value="<?php echo $row['answer_2']; ?>">
                </div>
                <div class="form-group">
                    <label for="answer_3">Réponse 3:</label>
                    <input type="text" class="form-control" id="answer_3" name="answer_3" value="<?php echo $row['answer_3']; ?>">
                </div>
                <button type="submit" name="modify" class="btn btn-primary">Modifier</button>
            </form>
            <?php
        }
        
        if (isset($_POST['add'])) {
            $module = $_POST['module'];
            $question = $_POST['question'];
            $true_answer = $_POST['true_answer'];
            $answer_1 = $_POST['answer_1'];
            $answer_2 = $_POST['answer_2'];
            $answer_3 = $_POST['answer_3'];
            
            $query = "INSERT INTO qcm_fr (module, question, true_answer, answer_1, answer_2, answer_3) VALUES ('$module', '$question', '$true_answer', '$answer_1', '$answer_2', '$answer_3')";
            $result = pg_query($con, $query);
            if ($result){
                echo "Ajouté avec succès.";
                header("refresh:1; url=history.php");
            }else{
                echo "Erreur lors de l'ajout.";
                header("refresh:1; url=history.php");
            }
        }
        ?>            

        <form action="history.php" method="post">
            <input type="hidden" name="add" value="true">
            <label for="module">Module :</label><br>
            <input type="text" name="module" required><br>
            <label for="question">Question :</label><br>
            <input type="text" name="question" required><br>
            <label for="true_answer">Réponse correcte :</label><br>
            <input type="text" name="true_answer" required><br>
            <label for="answer_1">Réponse 1 :</label><br>
            <input type="text" name="answer_1" required><br>
            <label for="answer_2">Réponse 2 :</label><br>
            <input type="text" name="answer_2" required><br>
            <label for="answer_3">Réponse 3 :</label><br>
            <input type="text" name="answer_3" required><br>
            <br>
            <input type="submit" value="Ajouter">
        </form> 
    </body>
</html>