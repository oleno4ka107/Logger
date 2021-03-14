<?php

namespace app\controllers;

use app\models\entities\Logger;
use app\models\entities\LoggerFactory;
use app\models\forms\LoggerForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @param string $type
     * @param string $format
     * @return string
     */
    public function actionIndex(string $type = 'txt', string $format = 'Y-m-d H:i:s'): string
    {
        $form = new LoggerForm();
        $form->type = $type;
        $form->format = $format;
        if($form->validate()){
            $form->createLog();
        }

        return $this->render('index', ['form' => $form]);
    }

}
