<?php

include_once '../config.php';

$service__id = $_GET['id'];

$sql = "SELECT * FROM services WHERE service__id='$service__id'";
$result = mysqli_query($conn, $sql);

// Transformer les résultat en tableau associative
$serviceDetails = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/style.css" />
    <title><?php echo $serviceDetails['service__name'] ?> - Salon de Beauté</title>
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
        <article class="service">
            <div class="service__image">
                <img src="../uploads/<?php echo $serviceDetails['service__img'] ?>" alt="">
            </div>
            <div class="service__detail">
                <h1 class="service__name"><?php echo $serviceDetails['service__name'] ?></h1>
                <p class="description">
                    <?php echo $serviceDetails['service__description'] ?>
                </p>

                <p class="price"><?php echo $serviceDetails['service__price'] ?> DA</p>

                <a href="../rendez-vous/?id=<?php echo $service__id ?>" class="btn">Prendre un rendez vous</a>
            </div>
        </article>
    </div>
</body>

</html>