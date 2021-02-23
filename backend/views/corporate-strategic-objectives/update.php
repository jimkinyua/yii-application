<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CorporateStrategicObjectives */

$this->title = 'Update Corporate Strategic Objectives: ' . $model->CorporateObjectiveId;
$this->params['breadcrumbs'][] = ['label' => 'Corporate Strategic Objectives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CorporateObjectiveId, 'url' => ['view', 'id' => $model->CorporateObjectiveId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="corporate-strategic-objectives-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
