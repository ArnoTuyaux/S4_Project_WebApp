<?php


header('Content-Type: application/json'); // ← Dis au navigateur que tu retournes du JSON
error_reporting(E_ALL); // ← Active tous les messages d'erreur
ini_set('display_errors', 1); // ← Affiche les erreurs (utile pour le dev)

require_once '../class/Reservation.php';

$response = ['success' => false]; // Valeur par défaut

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'update') {
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $tel = $_POST['tel'];
        $date = $_POST['date'];
        $horaire = $_POST['horaire'];
        $nb = $_POST['nb'];

        $success = Reservation::updateReservation($id, $nom, $tel, $date, $horaire, $nb);
        $response['success'] = $success;
    }

    if ($action === 'delete') {
        $id = $_POST['id'];
        $success = Reservation::deleteReservation($id);
        $response['success'] = $success;
    }
}

echo json_encode($response);

