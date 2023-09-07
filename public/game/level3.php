<?php
include 'functions.php';

$numbers = generateRandomNumbers(6); // assuming this function exists

// Store the original numbers in the session so we can compare them to the user's input later
$_SESSION['numbers'] = $numbers;
?>

<form id="level3" action="game.php" method="post" class="container-fluid  d-flex flex-column align-items-center justify-content-center vh-100">
    <h2>Level 3: Arrange these 6 numbers in Ascending order</h2>
    <h1 class="text-info"><?php echo implode(', ', $numbers); ?></h1><br>
    <input class="form-control w-25 m-3" type="number" name="number1" min="0" max="9" required>
    <input class="form-control w-25 mb-3" type="number" name="number2" min="0" max="9" required>
    <input class="form-control w-25 mb-3" type="number" name="number3" min="0" max="9" required>
    <input class="form-control w-25 mb-3" type="number" name="number4" min="0" max="9" required>
    <input class="form-control w-25 mb-3" type="number" name="number5" min="0" max="9" required>
    <input class="form-control w-25 mb-3" type="number" name="number6" min="0" max="9" required>
    <button class="btn btn-success m-3" type="submit">Submit</button>
    <a class="btn btn-danger m-3" href="startpage.php?abandon=true" name="abandon">Abandon Game</a>
</form>