<?php
$host = "peanut.db.elephantsql.com";
$user = "lhnhqbrm";
$pass = "KWjwsNe0T5pXCtXHh5M3tXy_ppanNir4";
$db = "lhnhqbrm";

// Open a PostgreSQL connection
$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
or die ("Could not connect to server\n");

// Closing connection
// pg_close($con);

?>