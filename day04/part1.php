<?php

function searchHorizontally($lines)
{
    $count = 0;

    foreach ($lines as $line) {
        $count += substr_count($line, XMAS);
        $count += substr_count(strrev($line), XMAS);
    }

    return $count;
}

function searchVertically($matrix, $height, $width)
{
    $count = 0;

    for ($i = 0; $i < $height - 3; $i++) {
        for ($j = 0; $j < $width; $j++) {
            $word = $matrix[$i][$j] . $matrix[$i + 1][$j] . $matrix[$i + 2][$j] . $matrix[$i + 3][$j];

            if ($word === XMAS || strrev($word) === XMAS) {
                $count++;
            }
        }
    }

    return $count;
}

function searchDiagonally($matrix, $height, $width)
{
    $count = 0;

    for ($i = 0; $i < $height - 3; $i++) {
        for ($j = 0; $j < $width - 3; $j++) {
            $wordA = $matrix[$i][$j] . $matrix[$i + 1][$j + 1] . $matrix[$i + 2][$j + 2] . $matrix[$i + 3][$j + 3];
            $wordB = $matrix[$i + 3][$j] . $matrix[$i + 2][$j + 1] . $matrix[$i + 1][$j + 2] . $matrix[$i][$j + 3];

            if ($wordA === XMAS || strrev($wordA) === XMAS) {
                $count++;
            }

            if ($wordB === XMAS || strrev($wordB) === XMAS) {
                $count++;
            }
        }
    }

    return $count;
}

const XMAS = "XMAS";

$input = file_get_contents("input.txt");
$lines = explode("\n", $input);
$matrix = [];
$answer = 0;

foreach ($lines as $line) {
    $letters = str_split($line);
    array_push($matrix, $letters);
}

$height = count($matrix);
$width = count($matrix[0]);

$answer += searchHorizontally($lines);
$answer += searchVertically($matrix, $height, $width);
$answer += searchDiagonally($matrix, $height, $width);

echo $answer . "\n";
