<?php
session_start();
// Si l'utilsateur n'est pas connecté
// Redériger vers la apge d'accueil
if (!$_SESSION["connecter"]) {
    header('Location: ../');
}

include_once '../config.php';



$sql = "SELECT first__name, last__name, telephone, date__reservation, heure__reservation, service__name
        FROM reservations INNER JOIN services ON
        reservations.service__id = services.service__id";

$result = mysqli_query($conn, $sql);

// Transformer les résultat en tableau associative
$reservationsArray = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/style.css" />
    <title>Réservations - Dashbaord</title>
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
        <div class="reservation__box__container">
            <?php
            foreach ($reservationsArray as $reservation) {
                echo '
                <ul class="reservation__box">
                    <li><strong>Nom et Prénom: </strong>' . $reservation['last__name'] . ' ' . $reservation['first__name'] . '</li>
                    <li><strong>Téléphone: </strong>' . $reservation['telephone'] . '</li>
                    <li><strong>Service: </strong>' . $reservation['service__name'] . '</li>
                    <li><strong>Date: </strong>' . $reservation['date__reservation'] . '</li>
                    <li><strong>Horaire: </strong>' . $reservation['heure__reservation'] . '</li>
                </ul>';
            }
            ?>
        </div>
    </div>
</body>

</html>