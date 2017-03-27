<?php
/**
 * User: Giel Berkers <giel@happy-online.nl>
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
    public static function echoProgress($current, $total)
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
        echo "Progress: [" . $progress . "] " . number_format($p, 2) . "% - ";
        // Show count:
        if ($current !== null && $total !== null) {
            echo "[" . $current . "/" . $total . "] - ";
        }
        // Show ETA:
        $elapsedSeconds = time() - self::$startTime;
        $etaSeconds = (1 - $percent) * ($elapsedSeconds / $percent);
        echo "ETA: " . date('H:i:s', $etaSeconds) . " - ";
        // Show memory usage:
        echo "MEM: " . $usage . "k  \r";
        if ($percent == 1) {
            unset(self::$startTime);
            echo "\n";
        }
    }
}
