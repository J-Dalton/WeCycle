<?php 

$pdo = new PDO('mysql:host=localhost; dbname=mdb_jd4986m; charset=utf8', 'root', '123');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);