<?php
require __DIR__ . '/../db/Database.php';

// Check if request is POST
if (isset($_POST['email'])) {
    echo Database::getResults($_POST['email']);
}
