<?php
session_start();

// Si l'utilsateur n'est pas connecté
// Redériger vers la apge d'accueil
if (!$_SESSION["connecter"]) {
    header('Location: ../');
}

include_once '../config.php';

$sql = "SELECT * FROM services";
$results = mysqli_query($conn, $sql);

$servicesArray = mysqli_fetch_all($results, MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/style.css" />
    <title>Tout les services - Salon de beauté</title>
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
                    <li><a href="../tout-services/">Tout Services</a></li>
                    <li><a href="../reservations/">Réservations</a></li>
                    <li><a href="../deconnexion">Deconnexion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="box_container">

            <?php
            foreach ($servicesArray as $service) {
                echo '<div class="box">
                    <div class="box_image">
                        <img src="../uploads/' . $service['service__img'] . '" alt="">
                    </div>
                    <h2 class="box__name">' . $service['service__name'] . '</h2>
                    <p class="box__price">' . $service['service__price'] . ' DA</p>
                    <br />
                    <a href="../modifier-service/?id=' . $service['service__id'] . '" class="btn">Modifié</a>
                </div>';
            }
            ?>

            <a href="../ajouter-service/" class="nouveau__box">+ Service</a>
        </div>
    </div>
</body>

</html>