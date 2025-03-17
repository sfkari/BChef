<?php

$idRecette = $_POST['idRecette'];

$insertQuery = "INSERT INTO favorites (id_recette) VALUES (:id_recette)";
$stmt = $connexion->prepare($insertQuery);
$stmt->bindParam(':id_recette', $idRecette);
$stmt->execute();

http_response_code(200);
?>
