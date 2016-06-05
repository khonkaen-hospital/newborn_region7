<?php

namespace app\modules\newborn\controllers;

use yii\web\Controller;

/**
 * Default controller for the `newborn` module
 */
class ReportController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
