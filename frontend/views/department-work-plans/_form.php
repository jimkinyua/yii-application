<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DepartmentWorkPlans */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-work-plans-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CorporateWorkPlanId')->textInput() ?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <?= $form->field($model, 'Code')->textInput() ?>

    <?= $form->field($model, 'Description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
