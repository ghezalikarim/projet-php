<?php
session_start();
// Si l'utilsateur n'est pas connecté
// Redériger vers la apge d'accueil
if (!$_SESSION["connecter"]) {
    header('Location: ../');
}

include_once '../config.php';

if (isset($_POST["submit"]) && $_POST["submit"] === "ajouter") {


    $service__name = $_POST["service__name"];
    $service__description = $_POST["service__description"];
    $service__price = $_POST["service__price"];

    // Générer un nom unique pour l'image téléverser
    $filename = uniqid() . "_" . $_FILES["image__upload"]["name"];
    $tmpname = $_FILES["image__upload"]["tmp_name"];



    $sql = "INSERT INTO services (
    service__name ,
    service__description ,
    service__price,
    service__img )
    VALUES (
        '$service__name',
        '$service__description',
        '$service__price',
        '$filename'
    );";

    $insertService = mysqli_query($conn, $sql);

    move_uploaded_file($tmpname, "../uploads/" . $filename);

    if ($insertService) {
        header('Location: ../tout-services');
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
    <title>Tout le services</title>
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
        <div class="ajouter__service__box">
            <h1 class="titre">Ajouter un service</h1>
            <form action="../ajouter-service/" method="POST" enctype="multipart/form-data">
                <div class="input">
                    <label for="">Nom du service</label>
                    <input type="text" name="service__name" required />
                </div>

                <div class="input">
                    <label for="">Description du service</label>
                    <textarea name="service__description" required></textarea>
                </div>

                <div class="input">
                    <label for="">Prix du service</label>
                    <input type="text" name="service__price" required />
                </div>

                <div class="input">
                    <label for="">Image du service</label>
                    <input type="file" required name="image__upload" />
                </div>

                <button type="submit" value="ajouter" name="submit" class="btn save margin-top">Enregistrer</button>
            </form>
        </div>
    </div>
</body>

</html>