<?php

require_once '../class/Plats.php';
header('Content-Type: application/json');

$nom = $_POST['NOM_PLAT'] ?? null;
$prix = $_POST['PRIX'] ?? null;
$type = $_POST['TYPE_PLAT'] ?? null;

if ($nom && $prix && $type) {
    $result = Plats::createPlat($nom, $prix, $type);

    if ($result) {
        echo json_encode(["success" => true, "message" => "Plat ajouté avec succès"]);
    } else {
        echo json_encode(["success" => false, "message" => "Échec de l'ajout"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Données incomplètes"]);
}

