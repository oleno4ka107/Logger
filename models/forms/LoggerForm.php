<?php

namespace app\models\forms;


use app\models\entities\Logger;
use app\models\entities\LoggerFactory;
use DateTime;
use Yii;
use yii\base\Model;

/**
 * Class LoggerForm
 * @package app\models\forms
 */
class LoggerForm extends Model
{
    public const CSV_TYPE = 'csv';
    public const TXT_TYPE = 'txt';
    /**
     * @var string
     */
    public string $type;

    /**
     * @var string
     */
    public string $format;


    private $logger;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['type', 'format'], 'required'],
            [['type', 'format'], 'string'],
            ['type', 'checkType'],
            ['format', 'checkFormat']
        ];
    }

    public static function getTypes(): array
    {
        return [
            self::CSV_TYPE,
            self::TXT_TYPE,
        ];
    }

    public function checkType($attribute)
    {
        if (!in_array($this->$attribute, self::getTypes())) {
            $this->addError($this->$attribute, 'Type  must be txt or csv');
        }
    }

    public function checkFormat($attribute)
    {
        if (!DateTime::createFromFormat($this->$attribute, date($this->$attribute))) {
            $this->addError($this->$attribute, 'Invalid format');
        }
    }

    public function createLog()
    {
        $filePath = Yii::$app->params['logPath'] . "log.$this->type";
        $loggerFactory = new LoggerFactory($filePath, $this->format);

        if ($this->type === self::TXT_TYPE) {
            $logger = $loggerFactory->createTXTLogger();
        } elseif ($this->type === self::CSV_TYPE) {
            $logger = $loggerFactory->createCSVLogger();
        }

        /** @var Logger $logger */
        $logger->log();
        $this->logger = $logger;
    }

    public function getLogFileContent()
    {
        return $this->logger ? $this->logger->getFileContent() : '';
    }
}
