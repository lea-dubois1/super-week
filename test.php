<?php

$conn = new \PDO('mysql:host=localhost;dbname=revisions', "root", "");

$sql = "SELECT * FROM book";
$req = $conn->prepare($sql);
$req->execute();

var_dump($req->fetchAll(PDO::FETCH_ASSOC));

?>