<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 12vh;
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
            color: white;
        }
    </style>
</head>
<body>

<ul>
    <li><a class="active" href="./mainHome.php">Home</a></li>
    <li><a href="./quiz.php">Quiz</a></li>
    <li><a href="./connectionPage.php">Connection</a></li>
    <li><a href="./inscriptionPage.php">Inscription</a></li>
</ul>

<div style="margin-left:10%;padding:1px 16px;height:0px;">
    <video src="../Video/vidTest.mp4"
           type="video/mp4" controls="" poster="">
    </video>
    <h2>Fixed Full-height Side Nav</h2>
    <h3>Try to scroll this area, and see how the sidenav sticks to the page</h3>
    <p>Notice that this div element has a left margin of 25%. This is because the side navigation is set to 25% width. If you remove the margin, the sidenav will overlay/sit on top of this div.</p>
    <p>Also notice that we have set overflow:auto to sidenav. This will add a scrollbar when the sidenav is too long (for example if it has over 50 links inside of it).</p>
    <p>Some text..</p>
    <p>Some text..</p>
    <p>Some text..</p>
    <p>Some text..</p>
    <p>Some text..</p>
    <p>Some text..</p>
    <p>Some text..</p>
</div>

</body>
</html>
