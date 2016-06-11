<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller
 *
 * @author Ilya Marinin<http://marinin.pw>
 */
class SiteController extends Controller {

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        if (Yii::$app->request->get('flush-cache') !== null) {
            Yii::$app->cache->flush();
        }

        $model = new \app\models\Site();

        $date = $model->getDate();

        return $this->render('index', [
                    'date' => $date,
        ]);
    }

}
