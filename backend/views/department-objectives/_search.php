<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DepartmentObjectivesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-objectives-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'DepartmentObjectiveId') ?>

    <?= $form->field($model, 'ObjectiveName') ?>

    <?= $form->field($model, 'StrategicObjectiveId') ?>

    <?= $form->field($model, 'DepartmentId') ?>

    <?= $form->field($model, 'DepartmentWorkPlanId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
