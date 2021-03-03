<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\JobGroups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-groups-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'JobGroup')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
