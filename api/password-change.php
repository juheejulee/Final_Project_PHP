<?php
require __DIR__ . '/../db/Database.php';

if (isset($_POST['email']) && isset($_POST['currentPassword']) && isset($_POST['newPassword'])) {

    $response = Database::changePassword($_POST['email'], $_POST['currentPassword'], $_POST['newPassword']);
    echo $response;
    http_response_code(json_decode($response, true)['status']);
}
