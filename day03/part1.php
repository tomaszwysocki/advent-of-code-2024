<?php

$input = file_get_contents("input.txt");
$lines = explode("\n", $input);
$mulRegex = "/mul\((\d+),(\d+)\)/";
$result = 0;


foreach ($lines as $line) {
    preg_match_all($mulRegex, $line, $matches);

    for ($i = 0; $i < count($matches[1]); $i++) {
        $result += (int)$matches[1][$i] * (int)$matches[2][$i];
    }
}

echo $result . "\n";
