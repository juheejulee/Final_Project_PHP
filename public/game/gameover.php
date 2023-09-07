<?php
$title = 'Game Over';
require __DIR__ . '/../header.php';

$indexPage = '../index.php';

if (!isset($_COOKIE['email'])) {
    header("Location: ../index.php");
}

$tries = 6;
$won = 0;
$email = $_COOKIE['email'];
$level = $_SESSION['level'] - 1;

session_unset();
session_destroy();
session_start();
?>


<body>
    <div class="container-fluid  d-flex flex-column align-items-center justify-content-center vh-100">
        <h1 class="text-danger">Game Over</h1>
        <p>Sorry, you have used all your lives. Better luck next time!</p>
        <a class="btn btn-info text-grey m-3" href="startpage.php">Play Again</a>
        <!-- Include your audio file -->
        <video class="m-3 rounded border border-info" autoplay muted id="myVideo" height="360">
            <source src="../assets/media/NEVERGIVEUP.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
        <audio autoplay>
            <source src="../assets/media/NEVER.mp3" type="audio/mp3">
            Your browser does not support the audio element.
        </audio>
    </div>
    <script>
        // Faite une requête AJAX pour mettre à jour le score de l'utilisateur
        (async function updateGames() {
            try {
                const email = '<?php echo $email ?>';
                const tries = '<?php echo $tries ?>';
                const level = '<?php echo $level ?>';
                const formData = new FormData();
                formData.append('email', email);
                formData.append('tries', tries);
                formData.append('won', 0);
                formData.append('level', level);
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
