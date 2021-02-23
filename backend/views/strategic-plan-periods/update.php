<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StrategicPlanPeriods */

$this->title = 'Update Strategic Plan Periods: ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Strategic Plan Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->PlanId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="strategic-plan-periods-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
