<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use \app\models\Feedback;
?>
<div class="post">
    <h2><?= Html::encode(Feedback::getSubjectById($model->subject)) ?></h2>

    <?= HtmlPurifier::process($model->content) ?>   

    <p>
        <a target="_blank" href="/uploads/<?= $model->file ?>">Смотреть файл</a>
    </p>
</div>
