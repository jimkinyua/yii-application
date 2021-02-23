<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\IndividualWorkPlan */

$this->title = 'Update Individual Work Plan: ' . $model->IndividualWorkPlanId;
$this->params['breadcrumbs'][] = ['label' => 'Individual Work Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->IndividualWorkPlanId, 'url' => ['view', 'id' => $model->IndividualWorkPlanId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="individual-work-plan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
