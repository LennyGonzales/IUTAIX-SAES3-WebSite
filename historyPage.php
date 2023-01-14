<?php
    session_start();
    require '../verifySession.php';
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../Css/scenario-style.css">
        <link rel="stylesheet"  type="text/css" href="../../Css/history-style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="icon" href="../../Image/logo-nws.png" type="image/ico" />
        <title>Modifications/ajouter des questions</title>
    </head>
    <body>
        <header class="header">
            <div class="logo">
                <img src="../../Image/logo-nws.png" alt="logo-nws">
            </div>

            <nav class="navbar">
                <a href="accueilPage.php" class="underline">Accueil</a>
            </nav>

        </header>

        <?php
        // Connexion à la base de données
        require("../connectionSQL.php");
        ?>

        <h1>Formulaire d'ajout questions à réponse écrite</h1>
        <form action="../addQuestion.php" method="post">
            Module: <input type="text" name="module"><br>
            Description: <input type="text" name="description"><br>
            Question: <input type="text" name="question"><br>
            Réponse vraie Ecrite: <input type="text" name="true_answer"><br>
            <input type="submit" name="add" value="Ajouter">
        </form>

        <br>
        <h1>Formulaire d'ajout questions à choix multiples</h1>
        <form action="../addQuestion.php" method="post">
            Module: <input type="text" name="module"><br>
            Description: <input type="text" name="description"><br>
            Question: <input type="text" name="question"><br>
            Réponse vraie <input type="number" name="true_answer" max="3" min="1"><br>
            Réponse 1: <input type="text" name="answer_1"><br>
            Réponse 2: <input type="text" name="answer_2"><br>
            Réponse 3: <input type="text" name="answer_3"><br>
            <input type="submit" name="add" value="Ajouter">
        </form>

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

                    <?php require '../ShowQcm.php' ?>

                </tbody>
            </table>
        </div>
        <div class="tabla-responsive">
            <table class="table-bordered">
                <thead>
                    <h1>Tableau questions à réponse écrite</h1>
                        <tr class="column"><th>Id</th>
                            <th>Module</th>
                            <th>Description</th>
                            <th>Question</th>
                            <th>Réponse question Ecrite</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                </thead>
                <tbody>

                    <?php require '../ShowWrittenResponseQuestion.php'; ?>

                </tbody>
            </table>
        </div>

<?php
    if(isset($_GET['update'])){
        require "../ShowUpdateFormQuestion.php";
    } else {
?>
<?php
}
?>
    </body>
</html>