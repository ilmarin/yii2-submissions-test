<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use app\models\Feedback;
use vova07\imperavi\Widget;

$this->title = 'Создать обращение';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-feedback">    
    <h1><?= Html::encode($this->title) ?></h1>     

    <p>
        Ваше обращение:
    </p>

    <div class="row">
        <div class="col-lg-5">            
            <?php Pjax::begin(); ?>
            <?php if (Yii::$app->session->hasFlash('feedbackFormSubmitted')): ?>

                <div class="alert alert-success">
                    <p>Обращение создано!</p>
                    <?= Html::a('Посмотреть', ['/feedback', 'id' => $id]) ?>
                </div>

            <?php endif; ?>
            <?php
            $form = ActiveForm::begin(['id' => 'feedback', 'options' => [
                            'enctype' => 'multipart/form-data',
                            'data' => ['pjax' => true]
            ]]);
            ?>

            <?=
            $form->field($model, 'subject')->dropdownList(
                    Feedback::feedbackCategories(), ['prompt' => 'Тема обращения']
            );
            ?>

            <?=
            $form->field($model, 'content')->widget(Widget::className(), [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 200,
                    'plugins' => [
                        'clips',
                        'fullscreen'
                    ]
                ]
            ]);
            ?>

            <?= $form->field($model, 'file')->fileInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'feedback-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>    
</div>
