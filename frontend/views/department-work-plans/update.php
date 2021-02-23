<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DepartmentWorkPlans */

$this->title = 'Update Department Work Plans: ' . $model->DepartmentWorkPlanId;
$this->params['breadcrumbs'][] = ['label' => 'Department Work Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DepartmentWorkPlanId, 'url' => ['view', 'id' => $model->DepartmentWorkPlanId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="department-work-plans-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
