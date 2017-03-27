<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\T_admin;

class PruebadbController extends Controller
{
    public function actionCopia()
    {
        $query = new T_admin;

        $emplea = $query->find()->all();

        return $this->render('copia', ['emplea' => $emplea]);
    }
}



 




