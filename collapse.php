<?php
$collapse = Arr::collapse([
    [1, 2, 3],
    [4, 5],
    [
        [6, 7]
    ]
]);

$flattenDefault = Arr::flatten([
    [1, 2, 3],
    [4, 5],
    [
        [6, 7]
    ]
]);

$flattenSingle = Arr::flatten([
    [1, 2, 3],
    [4, 5],
    [
        [6, 7]
    ]
], 1);

var_dump($collapse);
var_dump($flattenDefault);
var_dump($flattenSingle);

RESULTS:

array (size=6)
  0 => int 1
  1 => int 2
  2 => int 3
  3 => int 4
  4 => int 5
  5 => 
    array (size=2)
      0 => int 6
      1 => int 7

array (size=7)
  0 => int 1
  1 => int 2
  2 => int 3
  3 => int 4
  4 => int 5
  5 => int 6
  6 => int 7

array (size=6)
  0 => int 1
  1 => int 2
  2 => int 3
  3 => int 4
  4 => int 5
  5 => 
    array (size=2)
      0 => int 6
      1 => int 7