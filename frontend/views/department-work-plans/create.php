<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DepartmentWorkPlans */

$this->title = 'Create Department Work Plans';
$this->params['breadcrumbs'][] = ['label' => 'Department Work Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-work-plans-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
