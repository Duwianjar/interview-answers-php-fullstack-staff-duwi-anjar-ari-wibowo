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

function largestPalindromeProduct3DigitsDinamis(int $akhir, int $awal): array
{
    $hasil = [];
    $maxPalindrome = 0;
    $count = 0;



    for ($i = $akhir; $i >= $awal; $i--) {
        for ($j = $i; $j >= $awal; $j--) {
            $product = $i * $j;

            if ($product <= $maxPalindrome) {
                if ($count === 5) {
                    break;
                }
            }

            if (isPalindrome($product)) {
                $hasil[] = [
                    'max_palindrome' => $product,
                    'factor_a' => $i,
                    'factor_b' => $j,
                ];
                $count++;
                $maxPalindrome = max($maxPalindrome, $product);
            }
        }
    }

    return $hasil;
}


function inputA(): int
{
 $a = (int)readline('Input Akhir ');
 return $a;
}

function inputB(): int
{
 $b = (int)readline('Input Awal');
 return $b;
}

$a = inputA();
$b = inputB();

$numStr = (string)$a;
$digitCount = strlen($numStr);

$numStr2 = (string)$b;
$digitCount2 = strlen($numStr2);


while($digitCount2 != $digitCount){
   echo "digit awal dan akhir berbeda\n";
   $a = inputA();
   $b = inputB(); 
   $numStr = (string)$a;
   $digitCount = strlen($numStr);

   $numStr2 = (string)$b;
   $digitCount2 = strlen($numStr2);
}


// $result = largestPalindromeProduct3Digits();
$result = largestPalindromeProduct3DigitsDinamis($a, $b);

$sort = [];
$max = 0;
$countmax= 0; 

rsort($result);

foreach ($result as $item) {
    
   echo "Palindrome: {$item['max_palindrome']} ({$item['factor_a']} x {$item['factor_b']})\n";
}
// echo "Largest palindrome: {$result['palindrome']}\n";
// echo "Factors: {$result['factor_a']} x {$result['factor_b']}\n";
