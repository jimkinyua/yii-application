<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KeyResultAreasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="key-result-areas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'KeyResultAreaId') ?>

    <?= $form->field($model, 'TaskId') ?>

    <?= $form->field($model, 'EvaluationId') ?>

    <?= $form->field($model, 'AppraiseeRemarks') ?>

    <?= $form->field($model, 'SelfRating') ?>

    <?php // echo $form->field($model, 'SupervisorRating') ?>

    <?php // echo $form->field($model, 'SupervisorRemarks') ?>

    <?php // echo $form->field($model, 'Evidence_File') ?>

    <?php // echo $form->field($model, 'Ontime') ?>

    <?php // echo $form->field($model, 'FaultReason') ?>

    <?php // echo $form->field($model, 'AgreedScore') ?>

    <?php // echo $form->field($model, 'Achievements') ?>

    <?php // echo $form->field($model, 'IndividualObjectiveId') ?>

    <?php // echo $form->field($model, 'TaskDescription') ?>

    <?php // echo $form->field($model, 'WorkPlanWeight') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
