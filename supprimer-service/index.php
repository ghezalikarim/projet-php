<?php
session_start();
// Si l'utilsateur n'est pas connecté
// Redériger vers la apge d'accueil
if (!$_SESSION["connecter"]) {
    header('Location: ../');
}

include_once '../config.php';

$service__id = $_GET['id'];


$sql = "SELECT service__img FROM services WHERE service__id='$service__id'";
$result = mysqli_query($conn, $sql);
$service__img = mysqli_fetch_assoc($result);
$imagefileName = $service__img['service__img'];

if (is_file("../uploads/" . $imagefileName)) {
    unlink("../uploads/" . $imagefileName);
    echo $imagefileName;
}

$sql = "DELETE FROM services WHERE service__id='$service__id'";
$removeService = mysqli_query($conn, $sql);

if ($removeService) {
    header('Location: ../tout-services');
}
