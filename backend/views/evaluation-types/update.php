<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluationTypes */

$this->title = 'Update Evaluation Types: ' . $model->EvaluationTypeId;
$this->params['breadcrumbs'][] = ['label' => 'Evaluation Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->EvaluationTypeId, 'url' => ['view', 'id' => $model->EvaluationTypeId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evaluation-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
