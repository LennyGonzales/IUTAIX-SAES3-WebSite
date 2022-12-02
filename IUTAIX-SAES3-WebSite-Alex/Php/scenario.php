<!DOCTYPE html>
<html>
    <head>
        <title>Modifications/ajouter des questions</title>
    </head>
    <body>
        <form action="../Html/navBar.php">
            <input type="submit" value="Acceuil">
        </form>
        <a href="../App/downloadApp.php">
            <input type="submit" value="Télécharger l'App?">
        </a>
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
                    <th>Question</th>
                    <th>Réponse question</th>
                    <th>Réponse 1</th>
                    <th>Réponse 2</th>
                    <th>Réponse 3</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
        </table>
        <?php
        $query = "SELECT * FROM qcm_fr";
        $result = pg_query($con, $query);
        while($row = pg_fetch_assoc($result)){
             //Supprimer les questions
                    if(isset($_GET['delete'])){
                        $id=$_GET['delete'];
                        $sql="DELETE FROM QCM_FR WHERE ID='$id'";
                        $query=pg_query($sql);
                        if($query){
                            echo "Supprimer avec succes.";
                            header("refresh:0; url=scenario.php");
                        }else{
                            echo "ça n'a pas été supprimé.";
                            header("refresh:0; url=scenario.php");
                        }
                    }
            ?>
            <tr class="Rows">
                        <td><?php echo $row['id']?></td>&nbsp;
                        <td><?php echo $row['module']?></td>&nbsp;
                        <td><?php echo $row['question']?></td>&nbsp;
                        <td><?php echo $row['true_answer']?></td>&nbsp;
                        <td><?php echo $row['answer_1']?></td>&nbsp;
                        <td><?php echo $row['answer_2']?></td>&nbsp;
                        <td><?php echo $row['answer_3']?></td>&nbsp;
                        <td><a href="scenario.php?modify=<?php echo $row['id'] ?>" class="Mbutton"> Modifier</a></td>&nbsp;
                        <td><a href="scenario.php?delete=<?php echo $row['id'] ?>" class="Dbutton">Supprimer</a></td>&nbsp;
                        <br>
                        
                    </tr>
                    <?php
                   

                    //Modifier les questions
                    if(isset($_GET['modify'])){
                        $id = $_GET['modify'];
                        $sql= "SELECT * FROM QCM_FR WHERE id='$id'";
                        $query = pg_query($sql);
                        $row = pg_fetch_array($query);
                        $id = $row['id'];
                        $module = $row['module'];
                        $question = $row['question'];
                        $true_answer = $row['true_answer'];
                        $answer_1 = $row['answer_1'];
                        $answer_2 = $row['answer_2'];
                        $answer_3 = $row['answer_3'];
                        $modify = true;
                    }
                    if(isset($_POST['btn_edit'])){
                        $id = $_POST['id'];
                        $module = $_POST['module'];
                        $question = $_POST['question'];
                        $true_answer = $_POST['true_answer'];
                        $answer_1 = $_POST['answer_1'];
                        $answer_2 = $_POST['answer_2'];
                        $answer_3 = $_POST['answer_3'];
                        $sql = "UPDATE QCM_FR SET module = '$module', question = '$question', true_answer = '$true_answer', answer_1 = '$answer_1', answer_2 = '$answer_2', answer_3 = '$answer_3' WHERE id='$id'";
                        $query = pg_query($sql);

                        if($query){
                            echo "Modifier avec success";
                            header("refresh:0; url=scenario.php");
                        }else{
                            echo "ça n'a pas marché";
                            header("refresh:0; url=scenario.php");
                        }
                    }


        }
        ?>

        

        <?php
        if(isset($_REQUEST['module'], $_REQUEST['question'], $_REQUEST['true_answer'], $_REQUEST['answer_1'], $_REQUEST['answer_2'], $_REQUEST['answer_3'])){
            $module = stripslashes($_REQUEST['module']);
            $module = pg_escape_string($con, $module);
            
            $question = stripslashes($_REQUEST['question']);
            $question = pg_escape_string($con, $question);

            $true_answer = stripslashes($_REQUEST['true_answer']);
            $true_answer = pg_escape_string($con, $true_answer);
            
            $answer_1 = stripslashes($_REQUEST['answer_1']);
            $answer_1 = pg_escape_string($con, $answer_1);

            $answer_2 = stripslashes($_REQUEST['answer_2']);
            $answer_2 = pg_escape_string($con, $answer_2);
            
            $answer_3 = stripslashes($_REQUEST['answer_3']);
            $answer_3 = pg_escape_string($con, $answer_3);
            
            $query = "INSERT into QCM_FR (MODULE, QUESTION, TRUE_ANSWER, ANSWER_1, ANSWER_2, ANSWER_3) VALUES ('$module', '$question', '$true_answer', '$answer_1', '$answer_2', '$answer_3')";

            $res = pg_query($con, $query);

            if($res){
                echo "<div class='sucess'>
                      <h3>La question a été ajoutée.</h3>
                      </div>";
                      header("refresh:0; url=scenario.php");
              }else{
                echo "<h3>ça n'a pas été ajoutée.";
                header("refresh:0; url=scenario.php");

              }
        }else{
            ?>
            <form class="box" action="" method="post">
            <h1 class="box-logo box-title"> </h1>
            <h1 class="box-title">Table des questions</h1>
            <input type="text" class="box-input" name="module" placeholder="Module" required /> 
            <input type="text" class="box-input" name="question" placeholder="Question" required /> 
            <input type="text" class="box-input" name="true_answer" placeholder="Bonne réponse" required /> 
            <input type="text" class="box-input" name="answer_1" placeholder="Réponse 1" required /> 
            <input type="text" class="box-input" name="answer_2" placeholder="Réponse 2" required /> 
            <input type="text" class="box-input" name="answer_3" placeholder="Réponse 3" required /> 
            <?php if($modify==true){
                ?>
            <input type="submit" name="submit" value="Modifier" class="modify-button" onclick="$res" />

                <?php
            }else{
                ?>
            <input type="submit" name="submit" value="Ajouter" class="ajout-button" onclick="$res" />
                <?php
            }
            ?>
            </form>
            <?php
        }
        ?>          
    </body>
</html>