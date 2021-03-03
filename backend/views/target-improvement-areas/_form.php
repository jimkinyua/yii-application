<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TargetImprovementAreas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="target-improvement-areas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TargetId')->textInput() ?>

    <?= $form->field($model, 'Description')->textInput() ?>

    <?= $form->field($model, 'EmpNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AppraisalPeriodid')->textInput() ?>

    <?= $form->field($model, 'AppraiseeScore')->textInput() ?>

    <?= $form->field($model, 'SupervisorScore')->textInput() ?>

    <?= $form->field($model, 'Addressed')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
