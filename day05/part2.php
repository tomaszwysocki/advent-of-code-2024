<?php

function isUpdateCorrect($numbers, $before, $after)
{
    for ($i = 0; $i < count($numbers); $i++) {
        $currentNumber = $numbers[$i];
        for ($j = 0; $j < $i; $j++) {
            if (isset($after[$currentNumber]) && in_array($numbers[$j], $after[$currentNumber])) {
                return false;
            }
        }
        for ($j = $i + 1; $j < count($numbers); $j++) {
            if (isset($before[$currentNumber]) && in_array($numbers[$j], $before[$currentNumber])) {
                return false;
            }
        }
    }
    return true;
}

function modifiedInsertionSort(&$numbers, $before)
{
    for ($i = 1; $i < count($numbers); $i++) {
        $key = $numbers[$i];
        $j = $i - 1;

        while ($j >= 0) {
            $comparedNumber = $numbers[$j];
            if (isset($before[$comparedNumber]) && in_array($key, $before[$comparedNumber])) {
                $numbers[$j + 1] = $numbers[$j];
                $j--;
            } else {
                break;
            }
        }
        $numbers[$j + 1] = $key;
    }
}

$input = file_get_contents("input.txt");
[$rulesRaw, $updatesRaw] = explode("\n\n", $input);
$rules = explode("\n", $rulesRaw);
$updates = explode("\n", $updatesRaw);
$before = [];
$after = [];
$sum = 0;

foreach ($rules as $rule) {
    [$x, $y] = explode("|", $rule);

    if (!isset($before[$y])) {
        $before[$y] = [];
    }
    array_push($before[$y], $x);

    if (!isset($after[$x])) {
        $after[$x] = [];
    }
    array_push($after[$x], $y);
}

foreach ($updates as $update) {
    $numbers = explode(",", $update);

    if (!isUpdateCorrect($numbers, $before, $after)) {
        modifiedInsertionSort($numbers, $before);
        $middleNumber = $numbers[(count($numbers) - 1) / 2];
        $sum += $middleNumber;
    }
}

echo $sum . "\n";
