<?php

declare(strict_types=1);

function combinationSumOnce(array $nums, int $target): array
{
    $results = [];
    $current = [];
    $n = count($nums);

    $dfs = function (int $index, int $sum) use (&$dfs, $nums, $target, $n, &$results, &$current): void {
        if ($sum === $target) {
            $results[] = $current;
            return;
        }

        if ($sum > $target || $index >= $n) {
            return;
        }

        $current[] = $nums[$index];
        $dfs($index + 1, $sum + $nums[$index]);
        array_pop($current);

        $dfs($index + 1, $sum);
    };

    $dfs(0, 0);

    return $results;
}

$input = [5, 6, 14, 15, 18, 20, 10, 4, 3, 9, 13];
$k = 40;

$combinations = combinationSumOnce($input, $k);

echo "Input: [" . implode(", ", $input) . "]\n";
echo "Target: {$k}\n";
echo "Total combinations: " . count($combinations) . "\n";
echo "Combinations:\n";
foreach ($combinations as $combo) {
    echo "[" . implode(", ", $combo) . "]\n";
}
