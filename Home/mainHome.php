<html>
<head>
    <meta content="text/html; charset=ISO-8859-1"
          http-equiv="content-type">
    <title>Site web de l'app</title>
</head>
<body>
        <video src="../Video/vidTest.mp4"
               type="video/mp4" controls="" poster="">
        </video>
<br>
<br>
</body>
</html>

<form action="mainHome.php">
    <input type="submit" value="Acceuil">
</form>
<form action="quiz.php">
    <input type="submit" value="Quiz">
</form><form action="connectionPage.php">
    <input type="submit" value="Connection">
</form>
<br>
<form action="../App/Download.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fichier" />
    <input type="submit" value="Télécharger l'app" />
</form>
<form action="inscriptionPage.php">
    <input type="submit" value="Crée un compte">
</form>
<br>


<br>
<?php echo "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. "?>