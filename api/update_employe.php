<?php
require_once 'class/Employes.php';
$id = $_GET['id'] ?? null;
if ($id) {
    $result = Employes::updateEmploye($id, $nom, $secteurs);

    if ($result) {
        echo json_encode(["success" => true, "message" => "Plat mis à jour avec succès"]);
    } else {
        echo json_encode(["success" => false, "message" => "Échec de la mise à jour"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Données incomplètes"]);
}
