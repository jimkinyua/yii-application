<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PscRating;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model common\models\KeyResultAreas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="key-result-areas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SelfRating')->dropDownList(
        ArrayHelper::map(PscRating::find()->all(),
        'Rating','Description'),
        ['prompt'=>'Choose Rating'])
     ?>

    <?= $form->field($model, 'AppraiseeRemarks')->textInput() ?>

    

    <?= $form->field($model,'Ontime')->dropDownList(
        [1=>'On Schedule',0=>'Behind Schedule'],
        ['id'=>'evaluatetask-timeline_status',
        'prompt'=>'Select Timeline Status']);
     ?>

    <?= $form->field($model, 'FaultReason')->textInput() ?>

    <?= $form->field($model, 'Achievements')->textInput() ?>

    <?=$form->field($model,'files[]')
        ->widget(FileInput::className(),['options'=>['multiple'=>true],
            'pluginOptions'=>['previewFileType'=>'any',
            'showPreview' => false,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false]]
        );
     ?>

    <?php
     
    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

