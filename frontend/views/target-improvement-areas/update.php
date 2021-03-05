<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TargetImprovementAreas */

$this->title = 'Update Target Improvement Areas: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Target Improvement Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="target-improvement-areas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
