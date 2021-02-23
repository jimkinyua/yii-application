<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\IndividualObjectives */
/* @var $form yii\widgets\ActiveForm */
$max = (100 - $a_weight);
// print_r($max );
// exit;
?>

<div class="individual-objectives-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IndividualObjectiveName')->textarea(['rows' => '6']) ?>

    <?= $form->field($model, 'workplan_weight')->textInput(['type'=>'number' , 'max'=>$max])->hint('Objective weight contribution to the workplan e.g 10% ') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
