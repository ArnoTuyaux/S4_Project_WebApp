<?php
$id = $_GET['id'] ?? null;
if ($id) {
    require_once 'class/Employes.php';
    $serveur = Employes::getEmployeById($id);
    include 'vue/admin_ModifierEmployer.php';
} else {
    echo "ID manquant.";
}