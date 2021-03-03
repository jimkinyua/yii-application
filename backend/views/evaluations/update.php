<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Evaluations */

$this->title = 'Update Evaluations: ' . $model->EvaluationId;
$this->params['breadcrumbs'][] = ['label' => 'Evaluations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->EvaluationId, 'url' => ['view', 'id' => $model->EvaluationId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evaluations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
