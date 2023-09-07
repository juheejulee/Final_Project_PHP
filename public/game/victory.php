<?php
$title = 'Victory';
require __DIR__ . '/../header.php';

$indexPage = '../index.php';

if (!isset($_COOKIE['email'])) {
    header("Location: ../index.php");
}

$tries = 6 - $_SESSION['lives'];
$email = $_COOKIE['email'];

session_unset();
session_destroy();
session_start();
?>

<head>
    <link rel="stylesheet" href="../assets/css/confetti.css">
</head>

<body>
    <div class="confettis">
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
    </div>

    <div class="container-fluid  d-flex flex-column align-items-center justify-content-center vh-100">
        <h1 class="text-success">Congratulations!</h1>
        <p>You have successfully completed all the levels of the game!</p>
        <a class="btn btn-info text-grey m-3" href="startpage.php">Play Again</a>

        <!-- Include your audio file -->
        <audio autoplay>
            <source src="../assets/media/victory.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>
    <script>
        // Faite une requête AJAX pour mettre à jour le score de l'utilisateur
        (async function updateGames() {
            try {
                const email = '<?php echo $email ?>';
                const tries = '<?php echo $tries ?>';
                const formData = new FormData();
                formData.append('email', email);
                formData.append('tries', tries);
                formData.append('won', 1);
                formData.append('level', 6);
                const response = await fetch('../../api/update-score.php', {
                    method: 'POST',
                    body: formData
                })
                const data = await response.json();
                console.log(data);
            } catch (error) {
                console.log(error);
            }
        })();
    </script>
</body>

</html>

<?php
require __DIR__ . '/../cookie-timeout.php';
