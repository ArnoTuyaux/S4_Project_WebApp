<?php

$type = $_GET['type'] ?? 'Entree';

$response = file_get_contents("http://localhost/Projet_S4/api/get_menu.php?type=" . urlencode($type));

if ($response === false) {
    die("Erreur lors de l'appel API.");
}

$plats = json_decode($response, true);
include("views/administration/admin_Carte.php");