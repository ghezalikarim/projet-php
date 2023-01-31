<?php

include_once '../config.php';

$sql = "SELECT * FROM services";
$results = mysqli_query($conn, $sql);

// Transformer les résultat en tableau associative
$servicesArray = mysqli_fetch_all($results, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/style.css" />
    <title>Nos Services - Sallon De Beauté</title>
</head>

<body>
    <nav>
        <div class="container">
            <div class="barNavigation">
                <a href="../" class="logo">
                    <img src="../img/logo.png" alt="logo salon de beauté" />
                    <p>Salon de beauté</p>
                </a>

                <ul>
                    <li><a href="../">Accueil</a></li>
                    <li><a href="../nos-services/">Nos Service</a></li>
                    <li><a href="../connexion">Connexion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="box_container">
            <?php
            // Boucler les éléments du tableau $serviceArray
            foreach ($servicesArray as $service) {
                echo '<a href="../service?id=' . $service['service__id'] . '" class="box">
                        <div class="box_image">
                            <img src="../uploads/' . $service['service__img'] . '" alt="">
                        </div>
                        <h2 class="box__name">' . $service['service__name'] . '</h2>
                        <p class="box__price">' . $service['service__price'] . ' DA</p>
                    </a>';
            }
            ?>
        </div>
    </div>
</body>

</html>