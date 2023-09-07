<?php
$title = 'Game';
include '../header.php';

$indexPage = '../index.php';

if (!isset($_COOKIE['email'])) {
    header("Location: ../form/connection.php");
    exit;
}

// Check if there's a level in the session. If not, start with level 1.
if (!isset($_SESSION['level'])) {
    $_SESSION['level'] = 1;
}

// Check if there's a number of lives in the session. If not, start with 6 lives.
if (!isset($_SESSION['lives'])) {
    $_SESSION['lives'] = 6;
}
if ($_SESSION['lives'] <= 0) {
    header("Location: gameover.php");
    exit;
}

// If there's a message stored in the session, display it and then clear it
if (isset($_SESSION['message'])) {
    if (str_contains($_SESSION['message'], 'Congratulations')) {
        echo '
        <div class="alert alert-success alert-dismissible fade show z-3 position-absolute start-50 translate-middle-x" role="alert">
        ' . $_SESSION['message'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
        ';
    } else {
        echo '
        <div class="alert alert-warning alert-dismissible fade show z-3 position-absolute start-50 translate-middle-x" role="alert">
        ' . $_SESSION['message'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
        ';
    }
    unset($_SESSION['message']);
}

if (isset($_COOKIE['email'])) {
    echo $_COOKIE['email'] . ' is logged in.<br>';
}

if (isset($_SESSION['level'])) {
    echo 'Level: ' . $_SESSION['level'] . '<br>';
}
if (isset($_SESSION['lives'])) {
    echo 'Lives: ' . $_SESSION['lives'] . '<br>';
}
if (isset($_SESSION['firstLetter'])) {
    echo 'First letter: ' . $_SESSION['firstLetter'] . '<br>';
    echo 'Last letter: ' . $_SESSION['lastLetter'] . '<br>';
}

$is_correct = false; // Placeholder - replace with actual game logic
switch ($_SESSION['level']) {
    case 1:
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $submitted_letters = [
                $_POST['letter1'],
                $_POST['letter2'],
                $_POST['letter3'],
                $_POST['letter4'],
                $_POST['letter5'],
                $_POST['letter6'],
            ];

            $original_letters = str_split($_SESSION['letters']);
            sort($original_letters);
            sort($submitted_letters);

            if ($submitted_letters == $original_letters) {
                $_SESSION['message'] = "Congratulations! You've passed level 1!";
                $_SESSION['level']++;
            } else {
                $_SESSION['message'] = "Sorry, that's not correct.";
                $_SESSION['lives']--;
            }

            header("Location: game.php");
            exit;
        }
        include 'level1.php';
        break;

    case 2:
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $submitted_letters = [
                $_POST['letter1'],
                $_POST['letter2'],
                $_POST['letter3'],
                $_POST['letter4'],
                $_POST['letter5'],
                $_POST['letter6'],
            ];

            $original_letters = str_split($_SESSION['letters']);
            rsort($original_letters);
            rsort($submitted_letters);

            if ($submitted_letters == $original_letters) {
                $_SESSION['message'] = "Congratulations! You've passed level 2!";
                $_SESSION['level']++;
            } else {
                $_SESSION['message'] = "Sorry, that's not correct.";
                $_SESSION['lives']--;
            }

            header("Location: game.php");
            exit;
        }
        include 'level2.php';
        break;
    case 3:
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $submitted_numbers = [
                $_POST['number1'],
                $_POST['number2'],
                $_POST['number3'],
                $_POST['number4'],
                $_POST['number5'],
                $_POST['number6'],
            ];

            $submitted_numbers = array_map('intval', $submitted_numbers);
            $original_numbers = $_SESSION['numbers'];
            sort($original_numbers);
            sort($submitted_numbers);

            if ($submitted_numbers == $original_numbers) {
                $_SESSION['message'] = "Congratulations! You've passed level 3!";
                $_SESSION['level']++;
            } else {
                $_SESSION['message'] = "Sorry, that's not correct.";
                $_SESSION['lives']--;
            }

            header("Location: game.php");
            exit;
        }
        include 'level3.php';
        break;
    case 4:
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $submitted_numbers = [
                $_POST['number1'],
                $_POST['number2'],
                $_POST['number3'],
                $_POST['number4'],
                $_POST['number5'],
                $_POST['number6'],
            ];

            $original_numbers = $_SESSION['numbers'];
            rsort($original_numbers);
            rsort($submitted_numbers);

            if ($submitted_numbers == $original_numbers) {
                $_SESSION['message'] = "Congratulations! You've passed level 4!";
                $_SESSION['level']++;
            } else {
                $_SESSION['message'] = "Sorry, that's not correct.";
                $_SESSION['lives']--;
            }

            header("Location: game.php");
            exit;
        }
        include 'level4.php';
        break;
    case 5:
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $firstLetter = $_POST['firstLetter'];
            $lastLetter = $_POST['lastLetter'];

            if ($firstLetter == $_SESSION['letters'][0] && $lastLetter == $_SESSION['letters'][5]) {
                $_SESSION['message'] = "Congratulations! You've passed level 5!";
                $_SESSION['level']++;
            } else {
                $_SESSION['message'] = "Sorry, that's not correct.";
                $_SESSION['lives']--;
            }

            header("Location: game.php");
            exit;
        }
        include 'level5.php';
        break;
    case 6:
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $smallestNumber = (int)$_POST['smallestNumber'];
            $largestNumber = (int)$_POST['largestNumber'];


            if ($smallestNumber == min($_SESSION['numbers']) && $largestNumber == max($_SESSION['numbers'])) {
                $_SESSION['message'] = "Congratulations! You've passed level 6!";
                header("Location: victory.php");
                exit;
            } else {
                $_SESSION['message'] = "Sorry, that's not correct.";
                $_SESSION['lives']--;
            }

            header("Location: game.php");
            exit;
        }
        include 'level6.php';
        break;
}
if (isset($_SESSION['victory']) && $_SESSION['victory']) {
    header("Location: victory.php");
    exit;
}
?>

<script>
    const alert = document.getElementsByClassName('alert')[0];
    setTimeout(() => {
        alert.classList.add('d-none');
    }, 3000);
</script>

<?php
require __DIR__ . '/../cookie-timeout.php';
