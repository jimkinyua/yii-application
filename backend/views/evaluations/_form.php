<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Evaluations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'WorkPlanId')->textInput() ?>

    <?= $form->field($model, 'AppraisalPeriodid')->textInput() ?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <?= $form->field($model, 'Contested')->textInput() ?>

    <?= $form->field($model, 'EvaluationTypeId')->textInput() ?>

    <?= $form->field($model, 'EmpNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Code')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
