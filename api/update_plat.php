<?php
require_once '../class/Plats.php';
header('Content-Type: application/json');


$id = $_POST['ID_PLAT'] ?? null;
$nom = $_POST['NOM_PLAT'] ?? null;
$prix = $_POST['PRIX'] ?? null;
$type = $_POST['TYPE_PLAT'] ?? null;

if ($id && $nom && $prix && $type) {
    $result = Plats::updatePlat($id, $nom, $prix, $type);

    if ($result) {
        echo json_encode(["success" => true, "message" => "Plat mis à jour avec succès"]);
    } else {
        echo json_encode(["success" => false, "message" => "Échec de la mise à jour"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Données incomplètes"]);
}

