<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AreasOfImprovement */

$this->title = 'Create Areas Of Improvement';
$this->params['breadcrumbs'][] = ['label' => 'Areas Of Improvements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="areas-of-improvement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
