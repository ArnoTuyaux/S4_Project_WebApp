<?php
require_once '../class/CuisinierTicket.php';

$boissons = CuisinierTicket::getTicketExceptBoisson();

header('Content-Type: application/json');
echo json_encode($boissons);