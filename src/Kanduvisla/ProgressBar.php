<?php
/**
 * User: Giel Berkers <info@gielberkers.com>
 * Date: 27/03/2017
 * Time: 10:18
 */

namespace Kanduvisla;

/**
 * Class ProgressBar
 * @package Kanduvisla
 */
class ProgressBar
{
    /**
     * @var int
     */
    static $startTime;

    /**
     * Show progress bar
     * @param $current
     * @param $total
     */
    public static function show($current, $total)
    {
        $percent = $current / $total;
        $p = $percent * 100;

        // Set start time:
        if ($percent == 0 || $current == 1 || !isset(self::$startTime)) {
            self::$startTime = time();
        }

        $p2 = floor($p / 2);
        $progress = str_pad('', $p2, '=') . str_pad('', 50 - $p2);
        $usage = round(memory_get_usage() / 1024, 1);
        /// Show progressbar:
        echo "Progress: \033[33m[" . $progress . "]\033[0m \033[1;36m" . number_format($p, 2) . "%\033[0m - ";
        // Show count:
        if ($current !== null && $total !== null) {
            echo "\033[36m[" . $current . "/" . $total . "]\033[0m - ";
        }
        // Show ETA:
        $elapsedSeconds = time() - self::$startTime;
        $etaSeconds = (1 - $percent) * ($elapsedSeconds / $percent);
        echo "\033[36mETA: " . @date('H:i:s', $etaSeconds) . "\033[0m - ";
        
        // Show memory usage:
        echo "\033[34mMEM: " . $usage . "k\033[0m  \r";
        if ($percent == 1) {
            unset(self::$startTime);
            echo "\n";
        }
    }
}
