<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\IndividualWorkPlanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="individual-work-plan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'IndividualWorkPlanId') ?>

    <?= $form->field($model, 'Code') ?>

    <?= $form->field($model, 'Description') ?>

    <?= $form->field($model, 'EmpNo') ?>

    <?= $form->field($model, 'DeptObjvId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
