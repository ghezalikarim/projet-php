<?php
session_start();
// Si l'utilsateur n'est pas connecté
// Redériger vers la apge d'accueil
if (!$_SESSION["connecter"]) {
    header('Location: ../');
}

include_once '../config.php';

$service__id = $_GET['id'];

$sql = "SELECT * FROM services WHERE service__id='$service__id'";
$result = mysqli_query($conn, $sql);

// Transformer les résultat en tableau associative
$serviceDetails = mysqli_fetch_assoc($result);

if (isset($_POST["submit"]) && $_POST["submit"] === "modifier") {
    $service__name = $_POST["service__name"];
    $service__description = $_POST["service__description"];
    $service__price = $_POST["service__price"];

    // Générer un identifiant unique pour l'image téléverser
    // pour éviter les conflit de nom du fichier(image)
    $filename = uniqid() . "_" . $_FILES["image__upload"]["name"];
    $tmpname = $_FILES["image__upload"]["tmp_name"];



    if (!empty($_FILES['image__upload']['name'])) {
        // Si l'image a été changé
        // Mettre à jours les informations et le nom de la nouvelle image

        $sql = "UPDATE services SET service__name = '$service__name', service__description = '$service__description', service__price = '$service__price', service__img = '$filename' WHERE service__id = '$service__id';";
        $updateService = mysqli_query($conn, $sql);

        move_uploaded_file($tmpname, "../uploads/" . $filename);
        echo "filled";
    } else {
        // Si l'image n'as pas été modifié
        // Changer uniquement les informations

        $sql = "UPDATE services SET service__name = '$service__name', service__description = '$service__description', service__price = '$service__price' WHERE service__id = '$service__id';";
        $updateService = mysqli_query($conn, $sql);
        echo "empty";
    }

    // Rederiger vers la page de tout les services
    if ($updateService) {
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
            <h1 class="titre">Modifier</h1>

            <form action="../modifier-service/?id=<?php echo $service__id ?>" method="POST" enctype="multipart/form-data">
                <div class="input">
                    <label for="">Nom du service</label>
                    <input type="text" name="service__name" value="<?php echo $serviceDetails['service__name'] ?>" required />
                </div>

                <div class="input">
                    <label for="">Description du service</label>
                    <textarea name="service__description" required><?php echo $serviceDetails['service__description'] ?></textarea>
                </div>

                <div class="input">
                    <label for="">Prix du service</label>
                    <input type="text" name="service__price" value="<?php echo $serviceDetails['service__price'] ?>" required />
                </div>

                <div class="input">
                    <label for="">Image du service</label>
                    <input type="file" name="image__upload" />
                </div>

                <a href="../supprimer-service/?id=<?php echo $service__id ?>" class="btn delete margin-top">Supprimé</a>
                <button type="submit" name="submit" value="modifier" class="btn save margin-top">Enregistrer</button>
            </form>

        </div>
    </div>
</body>

</html>