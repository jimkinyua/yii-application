<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;



/* @var $this yii\web\View */
/* @var $model common\models\EvaluationTypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluation-types-form">


    <?php $form = ActiveForm::begin([  ]); ?>

    <?= $form->field($model, 'Description')->textInput() ?>

    <?= $form->field($model, 'StartDate')->widget(
            DatePicker::className(), [
            'inline' => false,
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-m-d',
                'size'=>'sm',

            ]
        ]);
    ?>

    <?= $form->field($model, 'EndDate')->widget(
            DatePicker::className(), [
            'inline' => false,
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-m-d',
                'size'=>'sm',

            ]
        ]);
    ?>


    <?= $form->field($model, 'Deadline')->widget(
            DatePicker::className(), [
            'inline' => false,
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-m-d',
                'size'=>'sm',

            ]
        ]);
    ?>
    


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
