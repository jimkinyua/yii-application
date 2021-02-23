<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CorporateWorkPlan */

$this->title = 'Update Corporate Work Plan: ' . $model->CorporateWorkPlanId;
$this->params['breadcrumbs'][] = ['label' => 'Corporate Work Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CorporateWorkPlanId, 'url' => ['view', 'id' => $model->CorporateWorkPlanId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="corporate-work-plan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
