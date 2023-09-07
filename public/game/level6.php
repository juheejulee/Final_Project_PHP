<?php
include 'functions.php';

$numbers = generateRandomNumbers(6);
// Store the original numbers in the session so we can compare them to the user's input later
$_SESSION['numbers'] = $numbers;

$shuffled = $numbers;
shuffle($shuffled);
?>

<form id="level6" action="game.php" method="post" class="container-fluid  d-flex flex-column align-items-center justify-content-center vh-100">
    <h2>Level 6: Identify the smallest and largest number in this set of 6 numbers</h2>
    <h1 class="text-info"><?php echo implode(', ', $numbers); ?></h1><br>
    <select class="form-select form-select-lg mb-3 w-25" aria-label=".form-select-lg example" name="smallestNumber">
        <option hidden>Smallest Number</option>
        <option value="<?php echo $shuffled[0]; ?>"><?php echo $shuffled[0]; ?></option>
        <option value="<?php echo $shuffled[1]; ?>"><?php echo $shuffled[1]; ?></option>
        <option value="<?php echo $shuffled[2]; ?>"><?php echo $shuffled[2]; ?></option>
        <option value="<?php echo $shuffled[3]; ?>"><?php echo $shuffled[3]; ?></option>
        <option value="<?php echo $shuffled[4]; ?>"><?php echo $shuffled[4]; ?></option>
        <option value="<?php echo $shuffled[5]; ?>"><?php echo $shuffled[5]; ?></option>
    </select>
    <select class="form-select form-select-lg mb-3 w-25" aria-label=".form-select-lg example" name="largestNumber">
        <option hidden>Largest Number</option>
        <option value="<?php echo $shuffled[0]; ?>"><?php echo $shuffled[0]; ?></option>
        <option value="<?php echo $shuffled[1]; ?>"><?php echo $shuffled[1]; ?></option>
        <option value="<?php echo $shuffled[2]; ?>"><?php echo $shuffled[2]; ?></option>
        <option value="<?php echo $shuffled[3]; ?>"><?php echo $shuffled[3]; ?></option>
        <option value="<?php echo $shuffled[4]; ?>"><?php echo $shuffled[4]; ?></option>
        <option value="<?php echo $shuffled[5]; ?>"><?php echo $shuffled[5]; ?></option>
    </select>
    <button class="btn btn-success m-3" type="submit">Submit</button>
    <a class="btn btn-danger m-3" href="startpage.php?abandon=true" name="abandon">Abandon Game</a>
</form>