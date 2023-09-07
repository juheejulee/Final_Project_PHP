<?php
require __DIR__ . '/../db/Database.php';

if (isset($_POST['email']) && isset($_POST['tries']) && isset($_POST['won']) && isset($_POST['level'])) {

    $response = Database::updateGames($_POST['email'], $_POST['tries'], $_POST['won'], $_POST['level']);
    echo $response;
    http_response_code(json_decode($response, true)['status']);
}
