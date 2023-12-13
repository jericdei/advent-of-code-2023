<?php

use Illuminate\Support\Facades\File;

function getDigit(string $input) {
    $digitWords = [
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9
    ];

    $matches = [];

    foreach ($digitWords as $word => $value) {
        $pos = 0;
        while (($pos = stripos($input, $word, $pos)) !== false) {
            $matches[$pos] = $value;
            $pos += strlen($word);
        }
    }

    // Match single digits and store their positions
    preg_match_all('/\b\d\b|\d/', $input, $singleDigits, PREG_OFFSET_CAPTURE);

    foreach ($singleDigits[0] as $match) {
        $matches[$match[1]] = (int)$match[0];
    }

    // Sort matches based on positions
    ksort($matches);

    $result = array_values($matches); // Reset array keys for consecutive numbering

    $count = count($result);

    $first = $result[0];
    $second = $count === 1 ? $first : $result[$count - 1];

    return (int) "$first$second";
}

$input = preg_split('~\R~', File::get('.tinkerun/day-1/input.txt'));

$total = 0;
$array = [];

foreach ($input as $item) {
    $total += getDigit($item);
}

dd($total);
