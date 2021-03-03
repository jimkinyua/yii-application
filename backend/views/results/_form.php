<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Results */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="results-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'EvaluationId')->textInput() ?>

    <?= $form->field($model, 'EmployeeNo')->textInput() ?>

    <?= $form->field($model, 'EmployeeDepartment')->textInput() ?>

    <?= $form->field($model, 'JobLevel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AppraisalPeriodId')->textInput() ?>

    <?= $form->field($model, 'EvaluationType')->textInput() ?>

    <?= $form->field($model, 'Designation')->textInput() ?>

    <?= $form->field($model, 'Supervisor')->textInput() ?>

    <?= $form->field($model, 'SupervisorDesignation')->textInput() ?>

    <?= $form->field($model, 'Rating')->textInput() ?>

    <?= $form->field($model, 'WorkPlanScore')->textInput() ?>

    <?= $form->field($model, 'SoftSkillsScore')->textInput() ?>

    <?= $form->field($model, 'PerformanceSkillsScore')->textInput() ?>

    <?= $form->field($model, 'CoreValuesScore')->textInput() ?>

    <?= $form->field($model, 'Excellent')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
