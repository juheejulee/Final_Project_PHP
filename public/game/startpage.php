<?php
$title = 'Welcome';
require __DIR__ . '/../header.php';

$indexPage = '../index.php';

// If user pressed abandon, destroy the session and start a new one
if (isset($_GET['abandon'])) {
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['level'] = 1;
    header("Location: startpage.php");
}

// if (!isset($_COOKIE['email'])) {
//     header("Location: ../index.php");
// }

// Verifie si le niveau est défini, sinon le défini à 1
if (!isset($_SESSION['level'])) {
    $_SESSION['level'] = 1;
}
?>

<body>
    <div class="container-fluid  d-flex flex-column align-items-center justify-content-center vh-100">
        <h1>Welcome to Word Game</h1>
        <div class="d-flex flex-column align-items-center justify-content-center">
            <a href="game.php" class="btn btn-primary m-3">Start Game</a>
            <a href="history.php" class="btn btn-success m-3">History Results</a>
            <a href="../form/password-form.php" class="btn btn-info m-3">Change Password</a>
            <a href="../index.php?signout='true" class="btn btn-danger m-3">Sign Out</a>
        </div>
    </div>
    <script>
        window.history.forward(0);
    </script>
</body>

</html>

<?php
require __DIR__ . '/../cookie-timeout.php';
