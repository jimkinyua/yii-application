<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluateTargets */

$this->title = 'Update Evaluate Targets: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Evaluate Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evaluate-targets-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
