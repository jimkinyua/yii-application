<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\IndividualObjectives */

$this->title = 'Update Individual Objective';
$this->params['breadcrumbs'][] = ['label' => 'Individual Objectives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->IndividualObjectiveId, 'url' => ['view', 'id' => $model->IndividualObjectiveId]];
$this->params['breadcrumbs'][] = 'Update';
$assigned_weight = $a_weight;
?>
<div class="individual-objectives-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'a_weight'=>$assigned_weight

    ]) ?>

</div>
