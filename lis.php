<?php
/**
 * - Longest Increasing Subsequence (LIS) problem
 *   PHP translated from Java:
 *   http://www.sanfoundry.com/java-program-longest-increasing-subsequence-algorithm/
 *
 * @param array $X Sequence of integers
 * @return array LIS
 */
function lis(array $X) {
    $N = count($X);
    $M = [0];
    $P = [0];
    $L = 0;

    for ($i = 0; $i < $N; $i++) {
        $j = 0;

        for ($pos = $L ; $pos >= 1; $pos--) {
            if ($X[$M[$pos]] < $X[$i]) {
                $j = $pos;
                break;
            }
        }

        $P[$i] = $M[$j];

        if ($j === $L || $X[$i] < $X[$M[$j + 1]]) {
            $M[$j + 1] = $i;
            $L = max($L, $j + 1);
        }
    }

    $result = [];
    $pos = $M[$L];
    for ($i = $L - 1; $i >= 0; $i--) {
        $result[$i] = $X[$pos];
        $pos = $P[$pos];
    }

    return $result;
}

// Test cases
var_dump(lis([0, 8, 4, 12, 2, 10, 6, 14, 1, 9, 5, 13, 3, 11, 7, 15])); // array -> 0, 2, 6, 9, 11, 15
var_dump(lis([0, 1, 2, 3, 4, 5, 1, 3, 8])); // array -> 0, 1, 2, 3, 4, 5, 8
var_dump(lis([0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 2, 3, 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 0, 3])); // array -> 0, 1, 2, 3
