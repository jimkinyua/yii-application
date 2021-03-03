<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluateTasksImprovementAreas */

$this->title = 'Update Evaluate Tasks Improvement Areas: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Evaluate Tasks Improvement Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evaluate-tasks-improvement-areas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
