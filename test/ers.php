<?php

/**
 * Ratings are updated by: r' = r + con * (Sa - Se) + bonus
 *
 * https://www.europeangodatabase.eu/EGD/gor_calculator.php
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Horaceho\Ers;

$ers = new Ers\Ers();

$player = 2100.0;
$opponent = 2100.0;
$win = 1.0;
$loss = 0.0;

$win_update = $ers->update($player, $opponent, $win);
assert ($win_update == 2109.306);

$loss_update = $ers->update($player, $opponent, $loss);
assert ($loss_update == 2091.725);
