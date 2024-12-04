<?php

$input = file_get_contents("input.txt");
$line = str_replace("\n", "", $input);
$lineLength = strlen($line);
$mulRegex = "/mul\((\d+),(\d+)\)/";

$result = 0;
$offset = 0;
$do = 0;

while ($do !== false) {
    $dont = strpos($line, "don't()", $offset) ?: $lineLength;
    $slice = substr($line, $offset, $dont - $offset);
    $offset = $dont + 7 <= $lineLength ? $dont + 7 : $lineLength;

    preg_match_all($mulRegex, $slice, $matches);

    for ($i = 0; $i < count($matches[1]); $i++) {
        $result += (int)$matches[1][$i] * (int)$matches[2][$i];
    }

    $do = strpos($line, "do()", $offset);
    $offset = $do + 4 <= $lineLength ? $do + 4 : $lineLength;
}

echo $result . "\n";
