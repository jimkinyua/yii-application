<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NavisionJobGroups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="navision-job-groups-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Scale')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
