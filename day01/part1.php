<?php

$input = file_get_contents("input.txt");
$lines = explode("\n", $input);
$leftList = [];
$rightList = [];

foreach ($lines as $line) {
    [$leftValue, $rightValue] = explode("   ", $line);

    array_push($leftList, $leftValue);
    array_push($rightList, $rightValue);
}

sort($leftList);
sort($rightList);
$sum = 0;

for ($i = 0; $i < count($leftList); $i++) {
    $sum += abs((int)$leftList[$i] - (int)$rightList[$i]);
}

echo "{$sum}\n";
