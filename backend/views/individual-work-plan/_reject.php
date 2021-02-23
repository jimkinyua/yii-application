<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\IndividualWorkPlan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="individual-work-plan-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'RejectReason')->textarea(['rows' => '6']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
