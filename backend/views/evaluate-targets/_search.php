<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluateTargetsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluate-targets-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'WorkPlanId') ?>

    <?= $form->field($model, 'SelfRating') ?>

    <?= $form->field($model, 'SupervisorRating') ?>

    <?= $form->field($model, 'AgreedScore') ?>

    <?php // echo $form->field($model, 'SupervisorRemarks') ?>

    <?php // echo $form->field($model, 'TargetTypeId') ?>

    <?php // echo $form->field($model, 'Achievements') ?>

    <?php // echo $form->field($model, 'TargetId') ?>

    <?php // echo $form->field($model, 'EvaluationId') ?>

    <?php // echo $form->field($model, 'TargetDescription') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
