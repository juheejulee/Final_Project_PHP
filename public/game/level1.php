<?php
include 'functions.php';

$letters = generateRandomLetters(6);

// Store the original letters in the session so we can compare them to the user's input later
$_SESSION['letters'] = $letters;
?>

<form id="level1" action="game.php" method="post" class="container-fluid  d-flex flex-column align-items-center justify-content-center vh-100">
    <h2>Level 1: Arrange these 6 letters in ascending order</h2>
    <h1 class="text-info"><?php echo $letters; ?></h1><br>
    <select class="form-select form-select-lg mb-3 w-25" aria-label=".form-select-lg example" name="letter1">
        <option selected>Letter One</option>
        <option value="<?php echo substr($letters, 0, 1); ?>"><?php echo substr($letters, 0, 1); ?></option>
        <option value="<?php echo substr($letters, 1, 1); ?>"><?php echo substr($letters, 1, 1); ?></option>
        <option value="<?php echo substr($letters, 2, 1); ?>"><?php echo substr($letters, 2, 1); ?></option>
        <option value="<?php echo substr($letters, 3, 1); ?>"><?php echo substr($letters, 3, 1); ?></option>
        <option value="<?php echo substr($letters, 4, 1); ?>"><?php echo substr($letters, 4, 1); ?></option>
        <option value="<?php echo substr($letters, 5, 1); ?>"><?php echo substr($letters, 5, 1); ?></option>
    </select>
    <select class="form-select form-select-lg mb-3 w-25" aria-label=".form-select-lg example" name="letter2">
        <option selected>Letter Two</option>
        <option value="<?php echo substr($letters, 0, 1); ?>"><?php echo substr($letters, 0, 1); ?></option>
        <option value="<?php echo substr($letters, 1, 1); ?>"><?php echo substr($letters, 1, 1); ?></option>
        <option value="<?php echo substr($letters, 2, 1); ?>"><?php echo substr($letters, 2, 1); ?></option>
        <option value="<?php echo substr($letters, 3, 1); ?>"><?php echo substr($letters, 3, 1); ?></option>
        <option value="<?php echo substr($letters, 4, 1); ?>"><?php echo substr($letters, 4, 1); ?></option>
        <option value="<?php echo substr($letters, 5, 1); ?>"><?php echo substr($letters, 5, 1); ?></option>
    </select>
    <select class="form-select form-select-lg mb-3 w-25" aria-label=".form-select-lg example" name="letter3">
        <option selected>Letter Three</option>
        <option value=" <?php echo substr($letters, 0, 1); ?>"><?php echo substr($letters, 0, 1); ?></option>
        <option value="<?php echo substr($letters, 1, 1); ?>"><?php echo substr($letters, 1, 1); ?></option>
        <option value="<?php echo substr($letters, 2, 1); ?>"><?php echo substr($letters, 2, 1); ?></option>
        <option value="<?php echo substr($letters, 3, 1); ?>"><?php echo substr($letters, 3, 1); ?></option>
        <option value="<?php echo substr($letters, 4, 1); ?>"><?php echo substr($letters, 4, 1); ?></option>
        <option value="<?php echo substr($letters, 5, 1); ?>"><?php echo substr($letters, 5, 1); ?></option>
    </select>
    <select class="form-select form-select-lg mb-3 w-25" aria-label=".form-select-lg example" name="letter4">
        <option selected>Letter Four</option>
        <option value="<?php echo substr($letters, 0, 1); ?>"><?php echo substr($letters, 0, 1); ?></option>
        <option value="<?php echo substr($letters, 1, 1); ?>"><?php echo substr($letters, 1, 1); ?></option>
        <option value="<?php echo substr($letters, 2, 1); ?>"><?php echo substr($letters, 2, 1); ?></option>
        <option value="<?php echo substr($letters, 3, 1); ?>"><?php echo substr($letters, 3, 1); ?></option>
        <option value="<?php echo substr($letters, 4, 1); ?>"><?php echo substr($letters, 4, 1); ?></option>
        <option value="<?php echo substr($letters, 5, 1); ?>"><?php echo substr($letters, 5, 1); ?></option>
    </select>
    <select class="form-select form-select-lg mb-3 w-25" aria-label=".form-select-lg example" name="letter5">
        <option selected>Letter Five</option>
        <option value="<?php echo substr($letters, 0, 1); ?>"><?php echo substr($letters, 0, 1); ?></option>
        <option value="<?php echo substr($letters, 1, 1); ?>"><?php echo substr($letters, 1, 1); ?></option>
        <option value="<?php echo substr($letters, 2, 1); ?>"><?php echo substr($letters, 2, 1); ?></option>
        <option value="<?php echo substr($letters, 3, 1); ?>"><?php echo substr($letters, 3, 1); ?></option>
        <option value="<?php echo substr($letters, 4, 1); ?>"><?php echo substr($letters, 4, 1); ?></option>
        <option value="<?php echo substr($letters, 5, 1); ?>"><?php echo substr($letters, 5, 1); ?></option>
    </select>
    <select class="form-select form-select-lg mb-3 w-25" aria-label=".form-select-lg example" name="letter6">
        <option selected>Letter Six</option>
        <option value="<?php echo substr($letters, 0, 1); ?>"><?php echo substr($letters, 0, 1); ?></option>
        <option value="<?php echo substr($letters, 1, 1); ?>"><?php echo substr($letters, 1, 1); ?></option>
        <option value="<?php echo substr($letters, 2, 1); ?>"><?php echo substr($letters, 2, 1); ?></option>
        <option value="<?php echo substr($letters, 3, 1); ?>"><?php echo substr($letters, 3, 1); ?></option>
        <option value="<?php echo substr($letters, 4, 1); ?>"><?php echo substr($letters, 4, 1); ?></option>
        <option value="<?php echo substr($letters, 5, 1); ?>"><?php echo substr($letters, 5, 1); ?></option>
    </select>
    <button class="btn btn-success m-3" type="submit">Submit</button>
    <a class="btn btn-danger m-3" href="startpage.php?abandon=true" name="abandon">Abandon Game</a>
</form>