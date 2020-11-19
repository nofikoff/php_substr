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

// Input:"2hgwgdgwwwwwwwwwg"
// Output:"gwwwwwwwwwg"


// брут форс - двигем окошко подстроки
function maxSubstring($str)
{
    // количество уникальных символов - первый знак
    $k = $str[0];
    // валидация
    if ($k < 1 || $k > 6) die('First char is not number in 1-6 range');

    // строка без первой цифры
    $str = substr($str, 1);

    // валидация
    $number_unique_chars = strlen(count_chars($str, 3));
    if ($number_unique_chars < $k) die('Number too big');
    if ($number_unique_chars == $k) return $str;

    //длина строки
    $str_size = strlen($str);
    // левая граница
    $window_start = 0;
    // хэш таблица частотности уникальных символов символ => частота в текущей подстроке
    $char_frequency = [];
    //ответ
    $result = '';
    // двигаем окошко [window_start, window_end]
    // правая граница
    for ($window_end = 0; $window_end <= $str_size; $window_end++) {
        //последний символ в окне
        $right_char = $str[$window_end];
        // инит частотности последнего символа в окне
        if (!isset($char_frequency[$right_char])) $char_frequency[$right_char] = 0;
        $char_frequency[$right_char]++;

        // если в результате сдвига - у нас есть достаточное количество уникальных символов в окошке?
        // заходим сюда
        while (sizeof($char_frequency) > $k) {
            // сдвинем левую границу вправа до тех пор пока не получим 'k' уникальных символов в char_frequency
            // левый символ в окне
            $left_char = $str[$window_start];
            $char_frequency[$left_char]--;

            //если частотность левого символа в окне стала нулевая - удалям такой символ из хэш таблицы
            if ($char_frequency[$left_char] == 0) unset($char_frequency[$left_char]);
            //сдвигаем левую границу окна
            $window_start++;

            //найденный резалт больше предыдущего?
            if (strlen($result) < ($window_end - $window_start + 1)) {
                $result = substr($str, $window_start - 1, ($window_end - $window_start + 1));
            }
        }
    }
    return $result;

}

if (!isset($_GET['str'])) die('No str request');
echo "RESULT: " . maxSubstring($_GET['str']);







