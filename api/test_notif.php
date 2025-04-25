<?php
function sendNotificationToAndroid($ticket_id) {
    $serverKey = 'YAIzaSyBawPvtitB3uGiyfNYdlx2TZqRciJhIAjs';  // Remplacez par votre clé serveur FCM
    $deviceToken = 'd0UdCma6RzmOz7z1LDalQG:APA91bEDuT18pCJDeSGvy-YB9dEXJEV0rwUzty90EC_GRZTS0XvhSYM90nZum4I9Wjx9p7u7SYOhrwk49D4DKwmSaQuLOKm8oROtM8vdy6_xQnduFRx3T_c';   // Remplacez par le token du périphérique Android

    $notification = array(
        'title' => 'Boisson prête',
        'body'  => 'Les boissons pour la table ' . $ticket_id . ' sont prêtes.',
    );

    $fcmFields = array(
        'to'        => $deviceToken,
        'notification' => $notification,
    );

    $headers = array(
        'Authorization: key=' . $serverKey,
        'Content-Type: application/json',
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

sendNotificationToAndroid($ticket_id);
//if ($result) {
//    sendNotificationToAndroid($ticket_id);  // Appel de la fonction pour envoyer la notification
//    header("Location: ../index.php?page=boisson&success=1");
//} else {
//    header("Location: ../index.php?page=boisson&error=1");
//}
