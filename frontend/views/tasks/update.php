<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */

$this->title = 'Update Tasks: ' . $model->TaskId;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TaskId, 'url' => ['view', 'id' => $model->TaskId]];
$this->params['breadcrumbs'][] = 'Update';
$assigned_weight = $a_weight;

?>
<div class="tasks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'a_weight'=>$assigned_weight

    ]) ?>

</div>
