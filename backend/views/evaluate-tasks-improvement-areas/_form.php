<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluateTasksImprovementAreas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluate-tasks-improvement-areas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'EvaluationId')->textInput() ?>

    <?= $form->field($model, 'Description')->textInput() ?>

    <?= $form->field($model, 'SelfRating')->textInput() ?>

    <?= $form->field($model, 'SupervisorRating')->textInput() ?>

    <?= $form->field($model, 'AgreedScore')->textInput() ?>

    <?= $form->field($model, 'SupervisorRemarks')->textInput() ?>

    <?= $form->field($model, 'Achievements')->textInput() ?>

    <?= $form->field($model, 'Addressed')->textInput() ?>

    <?= $form->field($model, 'TargetImprovementAreaId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
