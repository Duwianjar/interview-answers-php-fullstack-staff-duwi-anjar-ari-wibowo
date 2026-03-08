<?php

declare(strict_types=1);

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

$words = ["bat", "tab", "tap", "pat", "cat"];
$result = groupAnagrams($words);

echo "Input: [" . implode(", ", $words) . "]\n";
echo "Grouped anagrams:\n";
foreach ($result as $group) {
    echo "[" . implode(", ", $group) . "]\n";
}
