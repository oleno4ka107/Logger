<?php


namespace app\models\entities;

use DateTime;

/**
 * Class TXTLogger
 * @package app\models\entities
 */
class TXTLogger extends Logger
{

    /**
     * @return mixed|void
     */
    public function log()
    {
        $date = new DateTime('NOW');
        file_put_contents(
            $this->filePath,
            $date->format($this->dateType) . "\r\n",
            FILE_APPEND | LOCK_EX
        );
    }
}
