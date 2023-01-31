<?php
session_start();

// Coordonné Admin
$ADMIN_EMAIL = "admin@email.com";
$ADMIN_PASSWORD = "admin";

$email = $_POST['email'];
$password = $_POST['password'];

if ($email === $ADMIN_EMAIL && $password === $ADMIN_PASSWORD) {

    // Création de variable connceter
    $_SESSION['connecter'] = true;
    header('Location: ../tout-services/');
}

// Si l'admin est connecté
// Redériger vers la page tout les services 
if ($_SESSION['connecter'] === true) {
    header('Location: ../tout-services/');
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
                    <li><a href="../">Accueil</a></li>
                    <li><a href="../nos-services/">Nos Service</a></li>
                    <li><a href="../connexion">Connexion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <form action="../connexion/" method="POST">
            <div class="rendezvous__box">

                <h1 class="titre">Connexion</h1>
                <div class="input">
                    <label for="">Email</label>
                    <input type="email" name="email" value="<?php echo $ADMIN_EMAIL ?>" />
                </div>

                <div class="input">
                    <label for="">Mot de passe</label>
                    <input type="password" name="password" value="<?php echo $ADMIN_PASSWORD ?>" />
                </div>

                <button type="submit" class="btn margin-top">Connexion</button>
        </form>
    </div>

    </div>
</body>

</html>