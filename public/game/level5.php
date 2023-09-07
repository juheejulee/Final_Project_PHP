<?php
include 'functions.php';


$letters = generateRandomLetters(6);
$lettersArray = str_split($letters);
sort($lettersArray);

// Store the original letters in the session so we can compare them to the user's input later
$_SESSION['letters'] = $lettersArray;
// randomize the letters
$shuffled = str_shuffle($letters);
?>

<form id="level5" action="game.php" method="post" class="container-fluid  d-flex flex-column align-items-center justify-content-center vh-100">
    <h2>Level 5: </h2>
    <h2>Find the first and last letter in this set based on their alphabetical order</h2>
    <h1 class="text-info"><?php echo $letters; ?></h1><br>
    <select class="form-select form-select-lg mb-3 w-25" aria-label=".form-select-lg example" name="firstLetter">
        <option hidden>First letter</option>
        <option value="<?php echo substr($shuffled, 0, 1); ?>"><?php echo substr($shuffled, 0, 1); ?></option>
        <option value="<?php echo substr($shuffled, 1, 1); ?>"><?php echo substr($shuffled, 1, 1); ?></option>
        <option value="<?php echo substr($shuffled, 2, 1); ?>"><?php echo substr($shuffled, 2, 1); ?></option>
        <option value="<?php echo substr($shuffled, 3, 1); ?>"><?php echo substr($shuffled, 3, 1); ?></option>
        <option value="<?php echo substr($shuffled, 4, 1); ?>"><?php echo substr($shuffled, 4, 1); ?></option>
        <option value="<?php echo substr($shuffled, 5, 1); ?>"><?php echo substr($shuffled, 5, 1); ?></option>
    </select>
    <select class="form-select form-select-lg mb-3 w-25" aria-label=".form-select-lg example" name="lastLetter">
        <option hidden>Last letter</option>
        <option value="<?php echo substr($shuffled, 0, 1); ?>"><?php echo substr($shuffled, 0, 1); ?></option>
        <option value="<?php echo substr($shuffled, 1, 1); ?>"><?php echo substr($shuffled, 1, 1); ?></option>
        <option value="<?php echo substr($shuffled, 2, 1); ?>"><?php echo substr($shuffled, 2, 1); ?></option>
        <option value="<?php echo substr($shuffled, 3, 1); ?>"><?php echo substr($shuffled, 3, 1); ?></option>
        <option value="<?php echo substr($shuffled, 4, 1); ?>"><?php echo substr($shuffled, 4, 1); ?></option>
        <option value="<?php echo substr($shuffled, 5, 1); ?>"><?php echo substr($shuffled, 5, 1); ?></option>
    </select>
    <button class="btn btn-success m-3" type="submit">Submit</button>
    <a class="btn btn-danger m-3" href="startpage.php?abandon=true" name="abandon">Abandon Game</a>
</form>