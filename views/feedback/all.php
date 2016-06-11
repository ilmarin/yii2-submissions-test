
<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = 'Список обращений';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-feedback-all">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php Pjax::begin(); ?>
            <?=
            ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_feedback',
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>