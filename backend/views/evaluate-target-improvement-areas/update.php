<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluateTargetImprovementAreas */

$this->title = 'Update Evaluate Target Improvement Areas: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Evaluate Target Improvement Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evaluate-target-improvement-areas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
