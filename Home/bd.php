<?php
// Variables
$HOST="peanut.db.elephantsql.com";
$DB_NAME="SAES3";
$USER="root";
$PASS="KWjwsNe0T5pXCtXHh5M3tXy_ppanNir4";

// Connect to DB
$db = new PDO("mysql:host=" . $HOST . ";dbname=" . $DB_NAME, $USER, $PASS);
// Display errors when occurs
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
?>