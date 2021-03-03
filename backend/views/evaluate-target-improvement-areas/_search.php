<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluateTargetImprovementAreasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluate-target-improvement-areas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'EvaluationId') ?>

    <?= $form->field($model, 'Description') ?>

    <?= $form->field($model, 'SelfRating') ?>

    <?= $form->field($model, 'SupervisorRating') ?>

    <?php // echo $form->field($model, 'AgreedScore') ?>

    <?php // echo $form->field($model, 'SupervisorRemarks') ?>

    <?php // echo $form->field($model, 'Achievements') ?>

    <?php // echo $form->field($model, 'Addressed') ?>

    <?php // echo $form->field($model, 'TargetImprovementAreaId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
