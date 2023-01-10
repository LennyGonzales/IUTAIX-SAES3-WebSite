<?php
$host = "peanut.db.elephantsql.com";
$user = "lhnhqbrm";
$pass = "KWjwsNe0T5pXCtXHh5M3tXy_ppanNir4";
$db = "lhnhqbrm";

try { 
$con = new PDO("pgsql:host=$host;dbname=$db", $user, $pass); 
} catch (PDOException $e) { 
die("Error!: " . $e->getMessage());
}
?>