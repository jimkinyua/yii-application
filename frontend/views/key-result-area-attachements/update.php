<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StrategicObjectives */

$this->title = 'Update Strategic Objectives: ' . $model->StrategicObjectiveId;
$this->params['breadcrumbs'][] = ['label' => 'Strategic Objectives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->StrategicObjectiveId, 'url' => ['view', 'id' => $model->StrategicObjectiveId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="strategic-objectives-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
