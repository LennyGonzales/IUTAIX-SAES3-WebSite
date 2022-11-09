<link href="../Css/styles.php" rel="stylesheet" type="text/css" media="all" />
<html>
<head>
    <meta content="text/html; charset=ISO-8859-1"
          http-equiv="content-type">
    <title>Site web de l'app</title>
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 10vh;
            background-color:  #e5e5e5 ;
            position: fixed;
            height: 100%;
            overflow: auto;
        }
        li a {
            display: block;
            color: black;
            padding: 8px 0 8px 16px;
            text-decoration: none;
        }

        li a.active {
            background-color:  #33adff;
            color: white;
        }

        li a:hover:not(.active) {
            background-color:  #e5e5e5;
            color: white;7
        }
    </style>

</head>
<body>


<ul>
    <li>
        <form action="mainHome.php">
            <input type="submit" value="Acceuil">
        </form>
    </li>
    <li>
        <form action="quiz.php">
            <input type="submit" value="Quiz">
        </form>
    </li>
    <li>
        <form action="connectionPage.php">
            <input type="submit" value="Connection">
        </form>
    </li>
    <li>
        <form action="../App/Download.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fichier" />
            <input type="submit" value="Télécharger l'app" />
        </form>
    </li>
    <li>
        <form action="inscriptionPage.php">
            <input type="submit" value="Crée un compte">
        </form>
    </li>

</ul>
<video src="../Video/vidTest.mp4"
       type="video/mp4" controls="" poster="">
</video>

<div style="...">
    <h2>Fixed Full-height Side Nav</h2>
    <h3>Try to scroll this area, and see how the sidenav sticks to the page</h3>
    <p>Notice that this div element has a left margin of 25%. This is because the side navigation is set to 25% width. If you remove the margin, the sidenav will overlay/sit on top of this div.</p>
    <p>Also notice that we have set overflow:auto to sidenav. This will add a scrollbar when the sidenav is too long (for example if it has over 50 links inside of it).</p>
    <p>Some text..</p>
</div>

</body>
</html>