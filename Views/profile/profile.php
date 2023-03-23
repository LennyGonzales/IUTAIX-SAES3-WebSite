<?php


echo "
    <section class='profile'>
        <h1>Profil</h1>
       
        <div class='profileBox'>
            <img class='profile-picture' src='/static/content/images/robot.png' alt='image profil'>
            <div class='info'>
                <h1>" . $A_view['email'] . "</h1>
                <h2>Status : " . $A_view['user_status'] . "</h2>
                <h2>Points : " . $A_view['points'] . "</p>
            </div>
        </div>
    </section>
";