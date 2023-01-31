<?php
session_start();

// Supprimer les variable de session
session_unset();
session_destroy();

// Redériger vers la page d'accueil
header('Location: ../');
