<?php

include("config.php");

function sendEmail($to, $subject, $html){

    $data = [
        "from" => FROM_NAME . " <" . FROM_EMAIL . ">",
        "to" => [$to],
        "subject" => $subject,
        "html" => $html
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.resend.com/emails");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer " . RESEND_API_KEY,
        "Content-Type: application/json"
    ]);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    return [
        "httpCode" => $httpCode,
        "response" => $response
    ];

}
?>