<?php

include_once '../config.php';

$service__id = $_GET['id'];

$sql = "SELECT service__name, service__price, service__img FROM services WHERE service__id='$service__id'";
$result = mysqli_query($conn, $sql);

// Transformer les résultat en tableau associative
$serviceDetails = mysqli_fetch_assoc($result);


if (isset($_POST["submit"]) && $_POST["submit"] === "reserver") {
    $first__name = $_POST['first__name'];
    $last__name = $_POST['last__name'];
    $telephone = $_POST['telephone'];
    $date__reservation = $_POST['date__reservation'];
    $heure__reservation = $_POST['heure__reservation'];

    $sql = "INSERT INTO reservations(
        first__name,
        last__name,
        telephone,
        date__reservation,
        heure__reservation,
        service__id )
        VALUES (
            '$first__name',
            '$last__name',
            '$telephone',
            '$date__reservation',
            '$heure__reservation',
            '$service__id'   
        );";

    $insertReservation = mysqli_query($conn, $sql);

    // Rederiger vers la page succès de réservation.
    if ($insertReservation) {
        header('Location: ../success');
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/style.css" />
    <title>Rendez-vous</title>
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
        <div class="connexion__box">
            <div class="rendezvous__service">
                <div class="rendezvous__image">
                    <img src="../uploads/<?php echo $serviceDetails['service__img'] ?>" alt="">
                </div>
                <h1 class="rendezvous__name"><?php echo $serviceDetails['service__name'] ?> - <?php echo $serviceDetails['service__price'] ?> DA</h1>
            </div>

            <form action="../rendez-vous/?id=<?php echo $service__id ?>" method="POST">
                <div class="input">
                    <label for="">Nom</label>

                    <input type="text" name="first__name" required />
                </div>

                <div class="input">
                    <label for="">Prénom</label>
                    <input type="text" name="last__name" required />
                </div>

                <div class="input">
                    <label for="">Téléphone</label>
                    <input type="number" name="telephone" required />
                </div>

                <div class="input">
                    <label for="">Date</label>
                    <input type="date" name="date__reservation" required />
                </div>

                <div class="input">
                    <label for="">Heure</label>
                    <input type="time" name="heure__reservation" required />
                </div>

                <button type="submit" name="submit" value="reserver" class="btn margin-top">Réserver maintenant</button>
            </form>
        </div>
    </div>
</body>

</html>