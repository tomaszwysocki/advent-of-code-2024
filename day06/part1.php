<?php

function howManyPositions($matrix)
{
    $solution = 0;
    $posX = -1;
    $posY = -1;
    $direction = "^";
    $visitedPlaces = [];

    foreach ($matrix as $idx => $line) {
        $guardX = array_search("^", $line);
        if (is_int($guardX)) {
            $posX = $guardX;
            $posY = $idx;
        }
        $visitedLine = array_fill(0, 10, ".");
        array_push($visitedPlaces, $visitedLine);
    }

    while ($posX >= 0 && $posX < count($matrix[0]) && $posY >= 0 && $posY < count($matrix)) {
        $visitedPlaces[$posY][$posX] = "X";

        switch ($direction) {
            case "^":
                if ($posY == 0) {
                    break 2;
                }
                if ($matrix[$posY - 1][$posX] === "#") {
                    $direction = ">";
                } else {
                    $posY -= 1;
                }
                break;

            case ">":
                if ($posX == count($matrix[0]) - 1) {
                    break 2;
                }
                if ($matrix[$posY][$posX + 1] === "#") {
                    $direction = "v";
                } else {
                    $posX += 1;
                }
                break;

            case "v":
                if ($posY == count($matrix) - 1) {
                    break 2;
                }
                if ($matrix[$posY + 1][$posX] === "#") {
                    $direction = "<";
                } else {
                    $posY += 1;
                }
                break;

            case "<":
                if ($posX == 0) {
                    break 2;
                }
                if ($matrix[$posY][$posX - 1] === "#") {
                    $direction = "^";
                } else {
                    $posX -= 1;
                }
                break;
        }
    }

    foreach ($visitedPlaces as $line) {
        $countLine = array_count_values($line);
        if (array_key_exists("X", $countLine)) {
            $solution += $countLine["X"];
        }
    }

    return $solution;
}

$input = file_get_contents("input.txt");
$lines = explode("\n", $input);
$matrix = [];

foreach ($lines as $line) {
    $positions = str_split($line);
    array_push($matrix, $positions);
}

$solution = howManyPositions($matrix);
echo $solution . "\n";
