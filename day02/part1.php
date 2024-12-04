<?php

function isReportSafe($levels)
{
    $isIncreasing = null;
    for ($i = 0; $i < count($levels) - 1; $i++) {
        $levelA = (int)$levels[$i];
        $levelB = (int)$levels[$i + 1];
        $difference = $levelA - $levelB;

        if ($i == 0) {
            $isIncreasing = $levelA < $levelB;
        }

        if ($isIncreasing) {
            $difference = -$difference;
        }

        if ($difference < 1 || $difference > 3) {
            return false;
        }
    }
    return true;
}

$input = file_get_contents("input.txt");
$reports = explode("\n", $input);


$score = 0;

foreach ($reports as $report) {
    $levels = explode(" ", $report);
    if (isReportSafe($levels)) {
        $score++;
    }
}

echo $score . "\n";
