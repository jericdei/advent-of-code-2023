<?php

use Illuminate\Support\Facades\File;

function getDigit(string $input): int
{
    $input = str_split($input);
    $first = $input[0];
    $second = null;

    foreach ($input as $char) {
        if (is_numeric($char)) {
            $first = $char;

            break;
        }
    }

    for ($i = count($input) - 1; $i > 0; $i--) {
        if (is_numeric($input[$i])) {
            $second = $input[$i];

            break;
        }
    }

    $second ??= $first;

    return intval("$first$second");
}

$input = preg_split('~\R~', File::get('.tinkerun/day-1/input.txt'));
$total = 0;

foreach ($input as $item) {
    $total += getDigit($item);
}

dd($total);
