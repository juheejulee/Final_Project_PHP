<?php

use function PHPSTORM_META\map;

function generateRandomLetters($length)
{
    $result = '';
    $asciiArray = array();
    while (count($asciiArray) < $length) {
        $randomNumber = rand(97, 122); // this will generate a random number between 97 and 122 which are the ascii numbers for a-z
        if (!in_array($randomNumber, $asciiArray)) { // this will check if the number is already in the array or not.
            $asciiArray[] = $randomNumber;
        }
    }
    foreach ($asciiArray as $ascii) {
        $result .= chr($ascii);
    }
    return $result;
}
function generateRandomNumbers($length)
{
    $numbers = [];

    while (count($numbers) < $length) {
        $randomNumber = rand(0, 9);
        if (!in_array($randomNumber, $numbers)) {
            $numbers[] = $randomNumber;
        }
    }

    return $numbers;
}
