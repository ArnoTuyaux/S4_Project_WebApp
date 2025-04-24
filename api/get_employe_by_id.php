<?php
require_once '../class/Employes.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $employe = Employes::getEmployeById($id);

    if ($employe) {
        echo json_encode($employe->toArray());
    }
}