<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DepartmentObjectives */

$this->title = 'Create Department Objectives';
$this->params['breadcrumbs'][] = ['label' => 'Department Objectives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-objectives-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
