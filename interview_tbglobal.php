<?php

declare(strict_types=1);

function printArrayFormatted(array $arr): void
{
    echo json_encode($arr, JSON_UNESCAPED_UNICODE) . PHP_EOL;
}

function isPalindrome(int $value): bool
{
    $str = (string) $value;
    return $str === strrev($str);
}

function largestPalindromeProduct3Digits(): array
{
    $maxPalindrome = 0;
    $factorA = 0;
    $factorB = 0;

    for ($i = 999; $i >= 100; $i--) {
        for ($j = $i; $j >= 100; $j--) {
            $product = $i * $j;

            if ($product <= $maxPalindrome) {
                break;
            }

            if (isPalindrome($product)) {
                $maxPalindrome = $product;
                $factorA = $i;
                $factorB = $j;
            }
        }
    }

    return [
        'palindrome' => $maxPalindrome,
        'factor_a' => $factorA,
        'factor_b' => $factorB,
    ];
}

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

function longestConsecutiveSubarray(array $nums): array
{
    if (empty($nums)) {
        return [];
    }

    $set = array_fill_keys($nums, true);
    $bestStart = null;
    $bestLength = 0;

    foreach ($set as $num => $_) {
        $num = (int) $num;

        if (isset($set[$num - 1])) {
            continue;
        }

        $current = $num;
        $length = 1;

        while (isset($set[$current + 1])) {
            $current++;
            $length++;
        }

        if ($length > $bestLength) {
            $bestLength = $length;
            $bestStart = $num;
        }
    }

    if ($bestStart === null) {
        return [];
    }

    $result = [];
    for ($i = 0; $i < $bestLength; $i++) {
        $result[] = $bestStart + $i;
    }

    return $result;
}

function jobSequencing(array $jobs): array
{
    usort($jobs, static function (array $a, array $b): int {
        return $b['profit'] <=> $a['profit'];
    });

    $maxDeadline = 0;
    foreach ($jobs as $job) {
        $maxDeadline = max($maxDeadline, (int) $job['deadline']);
    }

    $slots = array_fill(0, $maxDeadline + 1, null);
    $profit = 0;

    foreach ($jobs as $job) {
        for ($day = (int) $job['deadline']; $day >= 1; $day--) {
            if ($slots[$day] === null) {
                $slots[$day] = $job['id'];
                $profit += (int) $job['profit'];
                break;
            }
        }
    }

    return [
        'sequence' => array_values(array_filter($slots)),
        'profit' => $profit,
    ];
}

function groupAnagrams(array $words): array
{
    $groups = [];

    foreach ($words as $word) {
        $chars = str_split($word);
        sort($chars);
        $key = implode('', $chars);
        $groups[$key][] = $word;
    }

    return array_values($groups);
}

echo "=============================\n";
echo "QUESTION #1\n";
echo "=============================\n";
$q1 = largestPalindromeProduct3Digits();
echo "Largest palindrome: {$q1['palindrome']}\n";
echo "Factors: {$q1['factor_a']} x {$q1['factor_b']}\n\n";

echo "=============================\n";
echo "QUESTION #2\n";
echo "=============================\n";
$arrQ2 = [5, 6, 14, 15, 18, 20, 10, 4, 3, 9, 13];
$k = 40;
$q2 = combinationSumOnce($arrQ2, $k);
echo "Input: ";
printArrayFormatted($arrQ2);
echo "K: {$k}\n";
echo "Total combinations: " . count($q2) . "\n";
echo "Combinations:\n";
foreach ($q2 as $combo) {
    printArrayFormatted($combo);
}
echo "\n";

echo "=============================\n";
echo "QUESTION #3\n";
echo "=============================\n";
$arrQ3 = [100, 4, 200, 1, 3, 2, 2, 5, 6];
$q3 = longestConsecutiveSubarray($arrQ3);
echo "Input: ";
printArrayFormatted($arrQ3);
echo "Output: ";
printArrayFormatted($q3);
echo "\n";

echo "=============================\n";
echo "QUESTION #4 - CASE 1\n";
echo "=============================\n";
$jobs1 = [
    ['id' => 'A', 'deadline' => 4, 'profit' => 20],
    ['id' => 'B', 'deadline' => 1, 'profit' => 10],
    ['id' => 'C', 'deadline' => 1, 'profit' => 40],
    ['id' => 'D', 'deadline' => 1, 'profit' => 30],
];
$q4Case1 = jobSequencing($jobs1);
echo "Urutan job: ";
printArrayFormatted($q4Case1['sequence']);
echo "Maximum Profit: {$q4Case1['profit']}\n\n";

echo "=============================\n";
echo "QUESTION #4 - CASE 2\n";
echo "=============================\n";
$jobs2 = [
    ['id' => 'A', 'deadline' => 2, 'profit' => 100],
    ['id' => 'B', 'deadline' => 1, 'profit' => 19],
    ['id' => 'C', 'deadline' => 2, 'profit' => 27],
    ['id' => 'D', 'deadline' => 1, 'profit' => 25],
    ['id' => 'E', 'deadline' => 3, 'profit' => 15],
];
$q4Case2 = jobSequencing($jobs2);
echo "Urutan job: ";
printArrayFormatted($q4Case2['sequence']);
echo "Maximum Profit: {$q4Case2['profit']}\n\n";

echo "=============================\n";
echo "QUESTION #5\n";
echo "=============================\n";
$words = ["bat", "tab", "tap", "pat", "cat"];
$q5 = groupAnagrams($words);
echo "Input: ";
printArrayFormatted($words);
echo "Output: ";
printArrayFormatted($q5);
