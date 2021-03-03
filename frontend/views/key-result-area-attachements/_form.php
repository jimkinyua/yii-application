<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StrategicObjectives */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="strategic-objectives-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ObjectiveName')->textInput() ?>

    <?= $form->field($model, 'StrategicPlanId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
