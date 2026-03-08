<?php

declare(strict_types=1);

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

    $sequence = array_values(array_filter($slots));

    return [
        'sequence' => $sequence,
        'profit' => $profit,
    ];
}

$jobs1 = [
    ['id' => 'A', 'deadline' => 4, 'profit' => 20],
    ['id' => 'B', 'deadline' => 1, 'profit' => 10],
    ['id' => 'C', 'deadline' => 1, 'profit' => 40],
    ['id' => 'D', 'deadline' => 1, 'profit' => 30],
];

$jobs2 = [
    ['id' => 'A', 'deadline' => 2, 'profit' => 100],
    ['id' => 'B', 'deadline' => 1, 'profit' => 19],
    ['id' => 'C', 'deadline' => 2, 'profit' => 27],
    ['id' => 'D', 'deadline' => 1, 'profit' => 25],
    ['id' => 'E', 'deadline' => 3, 'profit' => 15],
];

$case1 = jobSequencing($jobs1);
$case2 = jobSequencing($jobs2);

echo "Case 1 sequence: [" . implode(", ", $case1['sequence']) . "]\n";
echo "Case 1 max profit: {$case1['profit']}\n\n";
echo "Case 2 sequence: [" . implode(", ", $case2['sequence']) . "]\n";
echo "Case 2 max profit: {$case2['profit']}\n";
