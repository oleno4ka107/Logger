<?php


namespace app\models\entities;

/**
 * Class LoggerFactory
 * @package app\models\entities
 */
class LoggerFactory
{
    /**
     * @var string
     */
    protected string $filePath;

    /**
     * @var string
     */
    protected string $dateType;

    public function __construct(string $filePath, $dateType)
    {
        $this->filePath = $filePath;
        $this->dateType = $dateType;
    }

    /**
     * @return TXTLogger
     */
    public function createTXTLogger(): TXTLogger
    {
        return new TXTLogger($this->filePath, $this->dateType);
    }

    /**
     * @return CSVLogger
     */
    public function createCSVLogger(): CSVLogger
    {
        return new CSVLogger($this->filePath, $this->dateType);
    }
}
