<?php
/**
 * User: Giel Berkers <info@gielberkers.com>
 * Date: 27/03/2017
 * Time: 10:24
 */

require_once('../src/Kanduvisla/ProgressBar.php');

use Kanduvisla\ProgressBar;

$totalIterations = rand(100, 200);

for ($currentIteration = 0; $currentIteration < $totalIterations; $currentIteration += 1) {
    ProgressBar::show($currentIteration, $totalIterations);
    usleep(rand(100000, 200000));
}