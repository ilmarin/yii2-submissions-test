<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\Feedback;
use app\models\File;

/**
 * Feedback controller
 *
 * @author Ilya Marinin<http://marinin.pw>
 */
class FeedbackController extends Controller {

    public function actionIndex($id = '') {
        $model = new Feedback();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->save()) {
                $model->upload();
                $id = Yii::$app->db->getLastInsertID();
                Yii::$app->session->setFlash('feedbackFormSubmitted');
                return $this->render('create', ['model' => $model, 'id' => $id]);
            }
        }

        $params = ['model' => $model];
        $template = 'create';

        if ($id) {
            $template = 'view';
            $model = $this->findModel($id);
            $fileModel = new File($model->file);
            $fileMimeType = $fileModel->getMimeType();
            $fileSize = $fileModel->getFileSize();
            $params = [
                'model' => $model,
                'fileMimeType' => $fileMimeType,
                'fileSize' => $fileSize,
            ];
        }

        return $this->render($template, $params);
    }

    public function actionAll() {
        $model = new Feedback;

        return $this->render('all', ['dataProvider' => $model->getProvider()]);
    }

    /**
     * Ищет запись по id и если не находит - бросает исключение
     * @param int $id
     * @return object
     * @throws NotFoundHttpException
     */
    protected function findModel($id) {
        if (($model = Feedback::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Искомая страница не существует');
        }
    }

}
