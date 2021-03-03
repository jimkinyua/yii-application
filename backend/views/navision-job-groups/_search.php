<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NavisionJobGroupsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="navision-job-groups-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'timestamp') ?>

    <?= $form->field($model, 'Scale') ?>

    <?= $form->field($model, 'Minimum Pointer') ?>

    <?= $form->field($model, 'Maximum Pointer') ?>

    <?= $form->field($model, 'House Allowance') ?>

    <?php // echo $form->field($model, 'Commuter Allowance') ?>

    <?php // echo $form->field($model, 'In Patient Limit') ?>

    <?php // echo $form->field($model, 'Out Patient Limit') ?>

    <?php // echo $form->field($model, 'Grade Identifier') ?>

    <?php // echo $form->field($model, 'Annual Increaments') ?>

    <?php // echo $form->field($model, 'Extreneous Allowance') ?>

    <?php // echo $form->field($model, 'Leave Allowance') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
