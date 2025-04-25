<?php
require_once '../class/BoissonTicket.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ticket_id'])) {
    $ticket_id = intval($_POST['ticket_id']);

    $result = BoissonTicket::terminerTicket($ticket_id);

    if ($result) {
        include ('../api/test_notif.php');
        header("Location: ../index.php?page=boisson&success=1");
    } else {
        header("Location: ../index.php?page=boisson&error=1");
    }
    exit();
}
