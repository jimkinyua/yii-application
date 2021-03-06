<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AreasOfImprovementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="areas-of-improvement-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'AreaImprovementId') ?>

    <?= $form->field($model, 'KeyResultId') ?>

    <?= $form->field($model, 'Description') ?>

    <?= $form->field($model, 'EmpNo') ?>

    <?= $form->field($model, 'AppraisalPeriodid') ?>

    <?php // echo $form->field($model, 'AppraiseeScore') ?>

    <?php // echo $form->field($model, 'SupervisorScore') ?>

    <?php // echo $form->field($model, 'Addressed') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
