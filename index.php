<?php
// take the str parameter being passed and find the longest substring
// that contains k unique characters, where k will be the first character from the string.
// The substring will start from the second position in the string because
// the first character will be the integer k. For example: if str is "2aabbacbaa"
// there are several substrings that all contain 2 unique characters,
// namely: ["aabba", "ac", "cb", "ba"], but your program should return "aabba"
// because it is the longest substring. If there are multiple longest substrings,
// then return the first substring encountered with the longest length.
// k will range from 1 to 6.


function countUniqueCharacters($str)
{
    return strlen(count_chars($str, 3));
}

function maxSubstring($str)
{
    // количество уникальных символов - первый знак
    $k = $str[0];
    // валидация
    if ($k < 1 || $k > 6) return ('First char is not number in 1-6 range');

    // строка без первой цифры
    $str = substr($str, 1);


    if (countUniqueCharacters($str) < $k) return ('Number too big');
    if (countUniqueCharacters($str) == $k) return $str;

    // переберем подстроку
    for ($subStrSize = strlen($str); $subStrSize > 0; $subStrSize--) {
        // выберем ри куда стартовать
        for ($i = 0; $i <= strlen($str) - $subStrSize; $i++) {
            $subStr = substr($str, $i, $i + $subStrSize);
            echo $subStr;
            if (countUniqueCharacters($subStr) === $k) {
                return $subStr;
            }
        }
    }


}

if (!isset($_GET['str'])) echo('No str request');
echo maxSubstring($_GET['str']);







