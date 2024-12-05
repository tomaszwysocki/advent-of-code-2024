<?php

function searchX($matrix, $height, $width)
{
    $count = 0;

    for ($i = 0; $i < $height - 2; $i++) {
        for ($j = 0; $j < $width - 2; $j++) {
            $wordA = $matrix[$i][$j] . $matrix[$i + 1][$j + 1] . $matrix[$i + 2][$j + 2];
            $wordB = $matrix[$i + 2][$j] . $matrix[$i + 1][$j + 1] . $matrix[$i + 0][$j + 2];

            if (($wordA === MAS || strrev($wordA) === MAS) && ($wordB === MAS || strrev($wordB) === MAS)) {
                $count++;
            }
        }
    }

    return $count;
}

const MAS = "MAS";

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

$answer += searchX($matrix, $height, $width);

echo $answer . "\n";
