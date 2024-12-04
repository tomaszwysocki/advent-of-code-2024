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

function isUnsafeReportSafe($levels)
{
    for ($i = 0; $i < count($levels); $i++) {
        $newLevels = $levels;
        array_splice($newLevels, $i, 1);

        if (isReportSafe($newLevels)) {
            return true;
        }
    }
    return false;
}

$input = file_get_contents("input.txt");
$reports = explode("\n", $input);
$score = 0;

foreach ($reports as $report) {
    $levels = explode(" ", $report);
    $isSafe = isReportSafe($levels);

    if (!$isSafe) {
        $isSafe = isUnsafeReportSafe($levels);
    }

    if ($isSafe) {
        $score++;
    }
}

echo $score . "\n";
