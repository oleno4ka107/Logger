<?php

namespace app\models\entities;


/**
 * Class Logger
 * @package app\models\entities
 */
abstract class  Logger
{
    /**
     * @var string
     */
    protected string $filePath;

    /**
     * @var string
     */
    protected string $dateType;

    /**
     * Logger constructor.
     * @param string $filePath
     * @param string $dateType
     */
    public function __construct(string $filePath, string $dateType)
    {
        $this->filePath = $filePath;
        $this->dateType = $dateType;
    }

    /**
     * @return mixed
     */
    abstract public function log();

    public function getFileContent()
    {
        try {
            return file_get_contents($this->filePath);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
