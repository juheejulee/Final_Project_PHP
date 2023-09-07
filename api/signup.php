<?php
require __DIR__ . '/../db/Database.php';

if (isset($_POST['name']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['pwd'])) {

    $response = Database::createUser($_POST['name'], $_POST['lname'], $_POST['email'], $_POST['pwd']);

    echo $response;
    http_response_code(json_decode($response, true)['status']);
}
