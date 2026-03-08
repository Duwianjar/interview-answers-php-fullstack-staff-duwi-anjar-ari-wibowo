<?php

declare(strict_types=1);

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

$result = largestPalindromeProduct3Digits();
echo "Largest palindrome: {$result['palindrome']}\n";
echo "Factors: {$result['factor_a']} x {$result['factor_b']}\n";
