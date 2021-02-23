<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
$max = (100 - $a_weight);

?>

<div class="tasks-form">
<span class="label label-info">Remaining weight to assign: <?=(100 - $a_weight)?></span>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TaskDescription')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'ExpectedOutPut')->textarea(['rows' => 6,'id'=>'expected_output']) ?>
    <?= $form->field($model, 'weight')->textInput(['type'=>'number', 'max'=>$max,'placeholder'=>'Should not exceed '.$max])->hint('Score weight is a percentage e.g 30') ?>
    <?= $form->field($model, 'ResourcesRequired')->textarea(['rows' => 6,'id'=>'resources_required'])->hint('Comma Separated') ?>
    <?= $form->field($model, 'KPI')->textarea(['rows' => 6,'id'=>'kpi'])->hint('Comma Separated') ?>

    <?= $form->field($model, 'Timeline')->widget(
            DatePicker::className(), [
            'inline' => false,
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-m-d',
                'size'=>'sm',

            ]
        ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


