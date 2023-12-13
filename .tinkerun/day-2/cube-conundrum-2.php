<?php

use Illuminate\Support\Facades\File;

$input = preg_split('~\R~', File::get('.tinkerun/day-2/input.txt'));

$result = [];
$total = 0;

foreach ($input as $game) {
    $exploded = explode(': ', $game);
    $cubes = preg_split('/(; |, )/', $exploded[1]);

    $grouped = collect($cubes)
        ->groupBy(function ($cube) {
            return explode(' ', $cube)[1];
        })
        ->map(function ($cubes) {
            return $cubes->map(fn ($cube) => (int) explode(' ', $cube)[0]);
        })
        ->map(fn ($cubes) => $cubes->max())
        ->values()
        ->toArray();

    $total += array_product($grouped);
}

dd($total);
