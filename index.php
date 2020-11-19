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

// Input:"3aabacbebebe"
// Output:"cbebebe"

// Input:"2aabbcbbbadef"
// Output:"bbcbbb"


function maxSubstring($str)
{
    // количество уникальных символов - первый знак
    $k = $str[0];
    // валидация
    if ($k < 1 || $k > 6) die('First char is not number in 1-6 range');

    // строка без первой цифры
    $str = substr($str, 1);

    // без первой цифры
    $number_unique_chars = strlen(count_chars($str,3));
    if ($number_unique_chars < $k) die('Number too big');
    if ($number_unique_chars == $k) return $str;

    $str_size = strlen($str);
    $window_start = 0;
    $max_length = 0;
    $char_frequency = [];

    # расширим диапазон окна [window_start, window_end]
    for ($window_end = 0; $window_end < $str_size; $window_end++) {
        $right_char = $str[$window_end];
        if (!isset($char_frequency[$right_char])) $char_frequency[$right_char] = 0;
        $char_frequency[$right_char] += 1;
        //print_r($char_frequency);
        # сдвинем левую границу окно до тех пор пока не получим 'k' уникальных символов в char_frequency
        while (sizeof($char_frequency) > $k) {
            $left_char = $str[$window_start];
            //echo "\nLEFT $left_char \n";
            $char_frequency[$left_char] -= 1;
            if ($char_frequency[$left_char] == 0) unset($char_frequency[$left_char]);
            $window_start += 1;  # сдвигаем левую границу окна

            # собираем статистику найденых окон
            $max_length_new = max($max_length, $window_end - $window_start + 1);
            //мы нашли больше существующего? $max_length
            if ($max_length_new > $max_length and !isset($result[$max_length_new])) {
                $result[$max_length_new] = substr($str, $window_start - 1, $max_length_new);
                //запоминаем максимальный успех
                $max_length = $max_length_new;
                //print_r($result);
            }
            //echo "\n max lengh $max_length \n";
        }
    }
    return $result[$max_length_new];

}

if (!isset($_GET['str'])) die('No str request');
echo maxSubstring($_GET['str']);







