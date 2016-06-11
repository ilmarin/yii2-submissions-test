<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use app\models\Feedback;
use yii\widgets\DetailView;
use yii\helpers\HtmlPurifier;
use yii\helpers\Html;

$this->title = 'Список обращений';
$this->title = Feedback::getSubjectById($model->subject);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-feedback">
    <h1><?= Html::encode($this->title) ?></h1>    

    <div class="row">
        <div class="col-lg-5">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'content',
                        'value' => HtmlPurifier::process($model->content),
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'file',
                        'value' => '<a target="_blank" href="/uploads/' . $model->file . '">Смотреть</a>',
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => null,
                        'label' => 'MIME-тип файла',
                        'value' => $fileMimeType,
                    ],
                    [
                        'attribute' => null,
                        'label' => 'Размер файла',
                        'value' => $fileSize . ' Mb',
                    ]
                ],
            ])
            ?>
        </div>
    </div>
</div>
