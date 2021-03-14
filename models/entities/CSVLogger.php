<?php


namespace app\models\entities;

use DateTime;

/**
 * Class Logger
 * @package app\models\entities
 */
class CSVLogger extends Logger
{
    /**
     * @return mixed|void
     */
    public function log()
    {
        $date = new DateTime('NOW');
        $fp = fopen($this->filePath, "a");
        fputcsv($fp, (array)$date->format($this->dateType));
        fclose($fp);
    }
}
