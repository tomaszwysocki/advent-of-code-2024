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

$occurrences = array_count_values($rightList);
$score = 0;

foreach ($leftList as $number) {
    if (in_array($number, $rightList)) {
        $score += (int)$number * (int)$occurrences[$number];
    }
}

echo $score . "\n";
