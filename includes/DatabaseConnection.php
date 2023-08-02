<?php 

$pdo = new PDO('mysql:host=localhost; dbname=mdb_jd4986m; charset=utf8', 'user', 'password');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);