<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ResultsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="results-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'EvaluationId') ?>

    <?= $form->field($model, 'EmployeeNo') ?>

    <?= $form->field($model, 'EmployeeDepartment') ?>

    <?= $form->field($model, 'JobLevel') ?>

    <?php // echo $form->field($model, 'AppraisalPeriodId') ?>

    <?php // echo $form->field($model, 'EvaluationType') ?>

    <?php // echo $form->field($model, 'Designation') ?>

    <?php // echo $form->field($model, 'Supervisor') ?>

    <?php // echo $form->field($model, 'SupervisorDesignation') ?>

    <?php // echo $form->field($model, 'Rating') ?>

    <?php // echo $form->field($model, 'WorkPlanScore') ?>

    <?php // echo $form->field($model, 'SoftSkillsScore') ?>

    <?php // echo $form->field($model, 'PerformanceSkillsScore') ?>

    <?php // echo $form->field($model, 'CoreValuesScore') ?>

    <?php // echo $form->field($model, 'Excellent') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
