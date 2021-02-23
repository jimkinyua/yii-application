<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TasksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'TaskId') ?>

    <?= $form->field($model, 'TaskDescription') ?>

    <?= $form->field($model, 'IndividualObjectiveId') ?>

    <?= $form->field($model, 'ExpectedOutPut') ?>

    <?= $form->field($model, 'ResourcesRequired') ?>

    <?php // echo $form->field($model, 'KPI') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'Timeline') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
