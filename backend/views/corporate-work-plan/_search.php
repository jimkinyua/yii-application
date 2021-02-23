<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CorporateWorkPlanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="corporate-work-plan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'CorporateWorkPlanId') ?>

    <?= $form->field($model, 'StrategicPlanId') ?>

    <?= $form->field($model, 'Status') ?>

    <?= $form->field($model, 'Code') ?>

    <?= $form->field($model, 'Description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
