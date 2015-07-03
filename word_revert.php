<?php
/**
 * - Revert words in the sentence
 *   Input:  hello world
 *   Output: olleh dlrow
 *
 * @param string $str Sentence to revert
 * @return string Sentence with reverted words
 */
function revert($str) {
    $arr = str_split($str);
    $out = ''; $revert = [];

    foreach ($arr as $char) {
        if ($char === ' ') {
            $out .= implode($revert).' ';
            $revert = [];
        } else {
            array_unshift($revert, $char);
        }
    }

    return $out.implode($revert);
}

// Test case
var_dump(revert('Hello World')); // string -> olleH dlroW
