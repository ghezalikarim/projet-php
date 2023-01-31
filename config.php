<?php
ini_set('display_errors', 1);

// Connexion à le serveur mysql
$conn = mysqli_connect('localhost', 'root', '');

if ($conn) {
    // Créer la base de données
    $sql = "CREATE DATABASE IF NOT EXISTS salonDB";
    $createDB = mysqli_query($conn, $sql);

    if ($createDB) {
        // Connexion à la base de données 
        $conn = mysqli_connect('localhost', 'root', '', 'salonDB');

        // Créer la table des services
        $sql = "CREATE TABLE IF NOT EXISTS services (
            service__id INT AUTO_INCREMENT PRIMARY KEY,
            service__name VARCHAR(255),
            service__description VARCHAR(255),
            service__price VARCHAR(255),
            service__img VARCHAR(255)
        );";

        $createServiceTable = mysqli_query($conn, $sql);

        if (!$createServiceTable) {
            echo "La table des services n'a pas été créer";
        }

        // Créer la table des réservations
        $sql = "CREATE TABLE IF NOT EXISTS reservations (
            reservation__id INT AUTO_INCREMENT PRIMARY KEY,
            first__name VARCHAR(255),
            last__name VARCHAR(255),
            telephone VARCHAR(255),
            date__reservation DATE,
            heure__reservation TIME,
            service__id INT,
            CONSTRAINT fk_service FOREIGN KEY (service__id) 
            REFERENCES services(service__id)
        );";

        $createReservationTable = mysqli_query($conn, $sql);

        if (!$createReservationTable) {
            echo "La table des réservations n'a pas été créer";
        }
    } else {
        echo "La base de données n'a pas été créer";
    }
} else {
    echo "connexion échoué";
}
