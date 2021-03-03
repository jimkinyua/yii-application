<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EvaluationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'EvaluationId') ?>

    <?= $form->field($model, 'WorkPlanId') ?>

    <?= $form->field($model, 'AppraisalPeriodid') ?>

    <?= $form->field($model, 'Status') ?>

    <?= $form->field($model, 'Contested') ?>

    <?php // echo $form->field($model, 'EvaluationTypeId') ?>

    <?php // echo $form->field($model, 'EmpNo') ?>

    <?php // echo $form->field($model, 'Code') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
