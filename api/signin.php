<?php
require __DIR__ . '/../db/Database.php';

if (isset($_POST['email']) && isset($_POST['pwd'])) {

    $response = Database::loginUser($_POST['email'], $_POST['pwd']);
    echo $response;
    http_response_code(json_decode($response, true)['status']);
}
