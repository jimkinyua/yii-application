<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluationTypesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluation-types-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'EvaluationTypeId') ?>

    <?= $form->field($model, 'Description') ?>

    <?= $form->field($model, 'StartDate') ?>

    <?= $form->field($model, 'EndDate') ?>

    <?= $form->field($model, 'Deadline') ?>

    <?php // echo $form->field($model, 'AppraisalPeriodId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
