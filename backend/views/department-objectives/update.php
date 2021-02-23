<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DepartmentObjectives */

$this->title = 'Update Department Objectives: ' . $model->DepartmentObjectiveId;
$this->params['breadcrumbs'][] = ['label' => 'Department Objectives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DepartmentObjectiveId, 'url' => ['view', 'id' => $model->DepartmentObjectiveId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="department-objectives-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
