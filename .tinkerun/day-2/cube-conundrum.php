<?php

use Illuminate\Support\Facades\File;

$input = preg_split('~\R~', File::get('.tinkerun/day-2/input.txt'));

$max = [
    'red' => 12,
    'green' => 13,
    'blue' => 14
];

$template = [
    'game_no' => null,
    'possible' => true,
];

$result = [];
$total = 0;

foreach ($input as $game) {
    $temp = $template;

    [$gameNoString, $cubesString] = explode(': ', $game);

    // Get the game number as an integer
    $temp['game_no'] = (int) str_replace('Game ', '', $gameNoString);

    // Get the cubes
    $cubes = explode('; ', $cubesString);

    foreach ($cubes as $cube) {
        $colorCubes = explode(', ', $cube);

        foreach ($colorCubes as $colorCube) {
            [$count, $color] = explode(' ', $colorCube);

            if ($count > $max[$color]) {
                $temp['possible'] = false;

                break;
            }
        }
    }

    if ($temp['possible'] === true) {
        $total += $temp['game_no'];
    }

    $result[] = $temp;
}

dd($total);
